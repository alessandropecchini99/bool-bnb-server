@extends('admin.layouts.base')

@vite(['resources/scss/payment-page.scss', 'resources/js/payment-page-script.js'])

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <div id="dropin-container"></div>
            <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}"> Back</a>
            <button id="add-card-button" class="btn button-add-card">Add Card</button>
        </div>

        <form id="payment-form" method="POST" action="{{ route('admin.processPayment', ['apartment' => $apartment]) }}">
            @csrf
            <input type="hidden" id="payment-method-nonce" name="payment_method_nonce">
            <input type="hidden" id="payment-amount" name="payment_amount" value="{{ $paymentAmount }}">
            <input type="hidden" id="selected-sponsorship" name="selected_sponsorship_id"
                   value="{{ $selectedSponsorshipId }}">
        </form>

        <div class="btn-utilites-pay">
            <button id="submit-payment-button" class="btn button-pay mt-3">PAY</button>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.40.2/js/dropin.js"></script>
@endsection
