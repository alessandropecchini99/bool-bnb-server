<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="overflow-hidden">

    @include('auth.includes.header')

    <div class="wrapper bg-secondary-subtle">
        <div class="container">
            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-md-8 col-lg-6 col-xl-5 rounded-3 bg-white shadow p-4">
                    <div class="d-flex align-items-center justify-content-center">
                        <img
                        src="{{ asset('logo-orizzontale.png') }}"
                        alt="logo"
                        class="logo-auth mb-3"
                        />
                    </div>
                    @yield('contents')
                </div>
            </div>
        </div>
    </div>

</body>
</html>
