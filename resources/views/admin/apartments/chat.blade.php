@extends('admin.layouts.base')

@section('content')
    @vite(['resources/js/message-icon.js'])
    <div class="h-100 d-flex gap-3 flex-column align-items-center justify-content-center">
        <h1 class="pt-3 pb-3 text-center">Apartment Messages</h1>
        <div class="mx-auto message-container d-flex gap-3 flex-wrap justify-content-center">
            @foreach($messages as $message)
                <div class="card d-flex flex-column gap-2 ms-message-card" style="width: 18rem;">
                    <div class="ms-card-body">
                        <h4 class="ms-card-title">{{ $message->guest_name }}</h4>
                        <a class="ms-card-text" target="_blank" href="mailto:{{ $message->guest_email }}">{{ $message->guest_email }}</a>
                        <p class="ms-card-body body-text">{{ $message->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        	<div class="d-flex gap-1 mt-3">
				<a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">Back</a>
		    </div>
    </div>
@endsection
