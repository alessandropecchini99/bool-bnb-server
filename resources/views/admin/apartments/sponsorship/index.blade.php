@extends('admin.layouts.base')
@section('content')

    @if (session('payment_fail'))
        <div class="alert alert-danger fw-bold">
            {{ session('payment_fail') }}
        </div>
    @endif

    <div class="body">
        <h1 class="text-accent">pricing</h1>

        <div class="plans">

            @foreach($availableSponsorships as $sponsorship)

                <div class="plan @if($sponsorship->level === 'Basic') plan--light @endif
                    @if($sponsorship->level === 'Premium') plan--accent @endif
                    @if($sponsorship->level === 'Deluxe') plan--top @endif">
                    <h2 class="plan-title">{{ $sponsorship->level }}</h2>

                    <p class="plan-price">{{ $sponsorship->price }}</p>

                    <p class="space"></p>

                    <p class="plan-price"><span>For {{ $sponsorship->duration }} Hours</span>
                    </p>

                    <p class="space"></p>

                    <form method="POST" action="{{ route('admin.apartments.sponsorship.payment', ['id' => $apartment->id]) }}">
                        @csrf
                        <input type="hidden" name="paymentAmount" value="{{ $sponsorship->price }}">
                        <input type="hidden" name="selectedSponsorshipId" value="{{ $sponsorship->id }}">
                        <button type="submit" class="btn-sponsor">Buy Now</button>
                    </form>

                </div>

            @endforeach

        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}"> Back</a>
        </div>

    </div>
@endsection
