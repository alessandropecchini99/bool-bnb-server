<?php

namespace App\Http\Controllers\Admin;

use App\Models\View;
use App\Models\Image;
use App\Models\Address;
use App\Models\Message;
use App\Models\Service;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Providers\ApartmentService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    private array $validations = [
        'name' => 'required|string|max:200',
        'rooms' => 'required|integer|min:1',
        'beds' => 'required|integer|min:1',
        'bathrooms' => 'required|integer|min:1',
        'square_meters' => 'required|integer|min:1',
        'address' => 'array',
        'address.*.street' => 'required|string|max:200',
        'address.*.city' => 'required|string|max:100',
        'address.*.zip' => 'required|string|max:10',
        'services' => 'array',
        'images' => 'array|min:5',
        'images.*.image_path' => 'string',
        'images.*.is_cover' => 'required|boolean',
    ];

    private $validations_messages = [
        'required' => 'Field :attribute is required.',
        'max' => 'Field :attribute must have max :max chars.',
        'min' => ':attribute must be min :min',
    ];

    public function updateSponsorshipStatus(Apartment $apartment)
    {
        $isSponsored = false;
        foreach ($apartment->sponsorships as $sponsorship) {
            if ($sponsorship->pivot->end_date >= now()) {
                $isSponsored = true;
            } else {
                $apartment->sponsorships()->detach();
            }
            break;
        }
        $apartment->update(['is_sponsored' => $isSponsored]);
    }

    public function index()
    {
        $user = Auth::user();
        $apartments = Apartment::where('user_id', $user->id)
            ->with(['user', 'address', 'services', 'images', 'messages', 'views', 'sponsorships'])
            ->orderBy('is_sponsored', 'DESC')
            ->get();
        foreach ($apartments as $apartment) {
            $this->updateSponsorshipStatus($apartment);
        }
        return view('admin.apartments.index', compact('apartments'));
    }


    public function create()
    {
        $services = Service::all();
        return view('Admin.apartments.create', compact('services'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate($this->validations, $this->validations_messages);
        $validatedData = $request->all();
        //        dd($validatedData)  ;

        // Salvare i dati nel database per gli apartment
        $newApartment = new apartment();
        $newApartment->name = $validatedData['name'];
        $newApartment->slug = Str::slug($newApartment->name);
        $newApartment->user_id = $user->id;
        $newApartment->rooms = $validatedData['rooms'];
        $newApartment->beds = $validatedData['beds'];
        $newApartment->bathrooms = $validatedData['bathrooms'];
        $newApartment->square_meters = $validatedData['square_meters'];
        $newApartment->save();

        if ($validatedData['services']) {
            $services = array_values($validatedData['services']);
            $newApartment->services()->sync($services);
        }

        // Address
        $newAddress = new Address();
        $newAddress->street = $validatedData['street'];
        $newAddress->city = $validatedData['city'];
        $newAddress->zip = $validatedData['zip'];
        $newAddress->latitude = $validatedData['latitude'];
        $newAddress->longitude = $validatedData['longitude'];
        $newAddress->apartment()->associate($newApartment);
        $newAddress->save();

        // Handle image upload and storage
        if ($request->hasFile('images')) {
            $images = [];
            $counter = 1;

            foreach ($request->file('images') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $imageName = "{$newApartment->id}-" . Str::slug($newApartment->name) . "_{$counter}" . ".{$extension}";
                // Store the image in the "public" disk (you can configure this in config/filesystems.php)
                $imagePath = $imageFile->storeAs('apartment_images', $imageName, 'public');

                if ($counter == 1) {
                    $images[] = [
                        'image_path' => $imagePath,
                        'is_cover' => true,
                    ];
                } else {
                    $images[] = [
                        'image_path' => $imagePath,
                        'is_cover' => false,
                    ];
                }

                $counter++;
            }

            // Associate images with the apartment
            $newApartment->images()->createMany($images);
        }

        return redirect()
            ->route('admin.apartments.index', ['apartment' => $newApartment])
            ->with('create_success', 'Apartment created successfully.');
    }


    public function show($id)
    {
        return redirect("http://localhost:5174/apartment/{$id}");
    }


    public function edit($id)
    {
        $apartment = Apartment::with('address', 'user', 'services', 'images')->find($id);
        $services = Service::all();
        return view('admin.apartments.edit', compact('apartment', 'services'));
    }


    public function update(Request $request, int $id)
    {
        $apartment = Apartment::findOrFail($id);

        $request->validate($this->validations, $this->validations_messages);
        $validatedData = $request->all();

        $apartment->update([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
            'rooms' => $validatedData['rooms'],
            'beds' => $validatedData['beds'],
            'bathrooms' => $validatedData['bathrooms'],
            'square_meters' => $validatedData['square_meters'],
        ]);

        if ($validatedData['services']) {
            $services = array_values($validatedData['services']);

            $apartment->services()->sync($services);
        }

        $apartment->address()->update([
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'zip' => $validatedData['zip'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
        ]);

        // Handle image updates
        if ($request->hasFile('images')) {
            // Remove existing images, if needed
            $apartment->images()->delete();

            // Process and store new images
            $images = [];
            $counter = 1;

            foreach ($request->file('images') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $imageName = "{$apartment->id}-" . Str::slug($apartment->name) . "_{$counter}" . ".{$extension}";
                $imagePath = $imageFile->storeAs('apartment_images', $imageName, 'public');

                if ($counter == 1) {
                    $images[] = [
                        'image_path' => $imagePath,
                        'is_cover' => true,
                    ];
                } else {
                    $images[] = [
                        'image_path' => $imagePath,
                        'is_cover' => false,
                    ];
                }

                $counter++;
            }

            // Associate images with the apartment
            $apartment->images()->createMany($images);
        }

        return redirect()->route('admin.apartments.index')->with('success', 'Apartment updated successfully');
    }


    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        if (!$apartment) {
            return response()->json(['message' => 'Apartment not found'], 404);
        }
        $apartment->address()->delete();
        $apartment->services()->detach();
        $apartment->sponsorships()->detach();
        $apartment->messages()->delete();
        $apartment->views()->delete();

        foreach ($apartment->images as $image) {
            Storage::delete($image->image_path);
        }
        $apartment->images()->delete();
        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('delete_success', 'Apartment deleted successfully.');
    }

    public function chat($id)
    {
        $messages = Message::where('apartment_id', $id)->get();
        return view('admin.apartments.chat', compact('messages'));
    }
}
