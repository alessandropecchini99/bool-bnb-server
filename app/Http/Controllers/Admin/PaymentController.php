<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Braintree\Gateway;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller {

    /**
     * @throws Exception
     */
    public function processPayment(Request $request, Apartment $apartment) {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '73nbpwd9qxc2rzsm',
            'publicKey' => 'cjwzqtj3ps8vmy95',
            'privateKey' => '4d5ab429d2c409a2ec43d587fe879af4',
        ]);
        $paymentAmount = $request->all()['payment_amount'];
        $result = $gateway->transaction()->sale([
            'amount' => $paymentAmount,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);
        if ($result->success) {
            $selectedSponsorshipId = $request->input('selected_sponsorship_id');
            $sponsorship = Sponsorship::find($selectedSponsorshipId);
            if ($sponsorship) {
                $apartment->sponsorships()->attach($selectedSponsorshipId, [
                    'init_date' => now(), // Set the start date to the current date and time
                    'end_date' => now()->addHours($sponsorship->duration), // Set the end date based on sponsorship duration
                ]);
                $apartment->update(['is_sponsored' => true]);
                return redirect()->route('admin.apartments.index')
                    ->with('success', 'Payment successful!')
                    ->with('apartment', $apartment);
            } else {
                return redirect()->back()->with('payment_fail', 'Selected sponsorship not found.');
            }
        } else {
            // Payment failed
            return redirect()->back()->with('payment_fail', 'Payment failed.');
        }
    }
}
