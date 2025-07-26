<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Acquisition') }}</title>

    <style>
        body {
            background-image: url('{{ asset('assets/img/bg-login1.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="mb-6">
            <img src="{{ asset('assets/img/logo1.jpg') }}" alt="Logo" class="h-16 w-auto">
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
