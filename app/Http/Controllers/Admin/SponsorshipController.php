<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller {
    public function index($id) {
        $apartment = Apartment::where('id', $id)
            ->with('sponsorships')
            ->first();
        // Check if the apartment is already sponsored
        if ($apartment->is_sponsored) {
            return redirect()->back()->with('already_sponsored', 'This apartment is already sponsored.');
        }
        $user = Auth::user();
        $availableSponsorships = Sponsorship::all();
        return view('admin.apartments.sponsorship.index',
            compact('availableSponsorships', 'user', 'apartment'));
    }

    public function payment(Request $request, $id) {
        // Retrieve the paymentAmount from the request
        $paymentAmount = $request->input('paymentAmount');
        $selectedSponsorshipId = $request->input('selectedSponsorshipId');
        // Remove comma and Euro symbol, then convert to a float
        $paymentAmount = str_replace(',', '.', str_replace('€', '', $paymentAmount));
        $paymentAmount = floatval($paymentAmount);
        // Ensure that the amount is in the correct format (x.xx)
        $paymentAmount = number_format($paymentAmount, 2, '.', '');

        $apartment = Apartment::where('id', $id)
            ->first();
        $user = Auth::user();
        return view('admin.apartments.sponsorship.payment',
            compact('apartment', 'user', 'paymentAmount', 'selectedSponsorshipId'));
    }
}
