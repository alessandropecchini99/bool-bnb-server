<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller {
    public function registerApartmentView(Request $request, int $id) {
        $apartment = Apartment::where('id', $id)->first();

        // Get the visitor's IP address from the request object
        $ip = $request->ip();

        $newView = new View();
        $newView->apartment_id = $id;
        $newView->ip = $ip;
        $newView->date = now();
        $newView->save();
        $newView->apartment()->associate($apartment);

        return response()->json('success');
    }
}
