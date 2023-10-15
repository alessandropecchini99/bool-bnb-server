<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class ApartmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        /*
         * sorting params -> order_direction = 'asc' / 'desc'
         *                   sort_by = 'sponsor' / 'availability'
         */

        // Get the request parameters for sorting
        $sortBy = $request->get('sort_by', 'sponsor'); // Default to sorting by sponsor if not specified
        $orderDirection = $request->get('order_direction', 'desc');
        $orderColumn = 'is_sponsored';
        //        $orderDirection = 'DESC';
        if ($sortBy === 'availability') {
            $orderColumn = 'is_available';
            //$orderDirection = 'DESC'; // Change to 'ASC' if you want availability in descending order
        }
        // Fetch apartments with the specified order
        $apartments = Apartment::with(['user', 'address', 'services', 'images', 'views', 'sponsorships'])
            ->orderBy($orderColumn, $orderDirection)
            ->get();

        return response()->json($apartments);
    }

    public function show($id): JsonResponse
    {
        $apartment = Apartment::with(['user', 'address', 'services', 'images', 'messages', 'views', 'sponsorships'])
            ->find($id);
        if (!$apartment) {
            return response()->json(['message' => 'Apartment not found'], 404);
        }
        return response()->json($apartment);
    }

    // END CRUDS

    public function getAllOrderedByAvailability(): JsonResponse
    {
        $apartments = Apartment::with(['user', 'address', 'services', 'images', 'views'])
            ->orderBy('is_available', 'desc')
            ->get();

        return response()->json($apartments);
    }

    public function getAllOrderedBySponsorship(): JsonResponse
    {
        $apartments = Apartment::with(['user', 'address', 'services', 'images', 'views'])
            ->orderByDesc('is_sponsored')
            ->get();

        return response()->json($apartments);
    }

    public function getImages($id): JsonResponse
    {
        $images = Apartment::find($id)->images;

        if (!$images) {
            return response()->json(['message' => 'Apartment images not found'], 404);
        }

        return response()->json($images);
    }

    public function getServices($id): JsonResponse
    {
        $services = Apartment::find($id)->services;

        if (!$services) {
            return response()->json(['message' => 'Apartment services not found'], 404);
        }

        return response()->json($services);
    }

    public function getViews($id): JsonResponse
    {
        $views = Apartment::find($id)->views;

        if (!$views) {
            return response()->json(['message' => 'Apartment views not found'], 404);
        }

        return response()->json($views);
    }

    public function getMessages($id): JsonResponse
    {
        $apartment = Apartment::with('messages')->find($id);

        if (!$apartment) {
            return response()->json(['message' => 'Apartment not found'], 404);
        }

        $messages = $apartment->messages;

        return response()->json($messages);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate(
            [
                'guest_name' => 'required|string|min:3',
                'guest_email'   => 'required|email',
                'message'       => 'required|string|min:10',
            ]
        );
        $apartmentId = $request->input('apartment_id');
        $name = $request->input('guest_name');
        $email = $request->input('guest_email');
        $message = $request->input('message');
        try {
            $apartment = Apartment::find($apartmentId);

            $newMessage = new Message();
            $newMessage->guest_name = $name;
            $newMessage->guest_email = $email;
            $newMessage->message = $message;
            $newMessage->apartment()->associate($apartment);
            $newMessage->save();
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false
            ], 200);
        }
        return response()->json([
            'status' => true
        ], 200);
    }

    public function search(Request $request): JsonResponse
    {
        // Get latitude, longitude, and radius from the request parameters
        $latitude = $request->input('lat');
        $longitude = $request->input('lon');
        $radius = $request->input('radius');
        $minBeds = $request->input('min_beds');
        $minRooms = $request->input('min_rooms');
        $requiredServices = $request->input('required_services');
        $apartments = $this->getApartmentsFiltered(
            $latitude,
            $longitude,
            $radius,
            $minBeds,
            $minRooms,
            $requiredServices
        );
        if (count($apartments) == 0) {
            return response()->json(['apartments' => null], 200);
        }
        return response()->json(['apartments' => $apartments]);
    }

    public function getApartmentsFiltered(
        $latitude,
        $longitude,
        $radius,
        $minBeds = null,
        $minRooms = null,
        $requiredServices = []
    ) {
        $earthRadius = 6371; // Earth's radius in kilometers
        $apartments = Apartment::select('apartments.*')
            ->selectRaw(
                "( $earthRadius * acos(
            cos( radians($latitude) )
            * cos( radians( addresses.latitude ) )
            * cos( radians( addresses.longitude ) - radians($longitude) )
            + sin( radians($latitude) )
            * sin( radians( addresses.latitude ) )
        )) AS distance"
            )
            ->join('addresses', 'apartments.id', '=', 'addresses.apartment_id')
            ->whereRaw("( $earthRadius * acos(
            cos( radians($latitude) )
            * cos( radians( addresses.latitude ) )
            * cos( radians( addresses.longitude ) - radians($longitude) )
            + sin( radians($latitude) )
            * sin( radians( addresses.latitude ) )
        )) <= ?", [$radius])
            ->orderBy('distance')
            ->with(['user', 'address', 'services', 'images', 'messages', 'views', 'sponsorships']);

        if ($minBeds !== null) {
            $apartments->where('beds', '>=', $minBeds);
        }

        if ($minRooms !== null) {
            $apartments->where('rooms', '>=', $minRooms);
        }

        if (!empty($requiredServices)) {
            $apartments->whereHas('services', function ($query) use ($requiredServices) {
                $query->whereIn('name', $requiredServices);
            }, '=', count($requiredServices));
        }
        return $apartments->get();
    }
}
