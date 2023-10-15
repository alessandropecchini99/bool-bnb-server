@extends('auth.layouts.base')

@section('contents')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                required
                autofocus
                autocomplete="name"
                value="{{ old('name') }}"
            >
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input
                type="text"
                class="form-control"
                id="last_name"
                name="last_name"
                required
                autofocus
                autocomplete="last_name"
                value="{{ old('last_name') }}"
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                required
                autofocus
                autocomplete="username"
                value="{{ old('email') }}"
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                required
                autocomplete="new-password"
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            >
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('login') }}">
                Already registered?
            </a>

            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>

@endsection
