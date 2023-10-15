@php $user = Auth::user() @endphp

@extends('admin.layouts.base')

@section('content')
    <div class="h-100 m-auto text-center d-flex flex-column align-items-center justify-content-center ms-dashboard">
        <h1 class="page-title fw-bold">
            Welcome {{ $user->name }}!
        </h1>
        <h4 class="mt-4">Use the buttons below to add a new apartment</h4>
        <h4>or to view a list of the ones you already added:</h4>
        <h4 class="mb-5">from there you will be able to perform various operations on each of them.</h4>
        <div class="d-flex justify-content-evenly ms-dash-btn">
            <a href="{{ route('admin.apartments.create') }}" class="btn px-4 py-3 fw-bold"
               style="background-color: #485ba1; color: white"><i class="bi bi-file-earmark-plus"></i> Add Apartment
            </a>
            <a href="{{ route('admin.apartments.index') }}" class="btn px-4 py-3 fw-bold"
               style="background-color: #9153a9; color: white"><i class="bi bi-file-earmark-plus"></i> Your
                Apartments</a>
        </div>
    </div>
@endsection
