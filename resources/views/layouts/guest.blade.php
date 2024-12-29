<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full sm:max-w-md text-center">
        <!-- Logo -->
        <a href="/" class="block mb-6">
            <x-application-logo class="w-20 h-20 mx-auto fill-current text-gray-500" />
        </a>

        <!-- Content -->
        <div class="px-6 py-4 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
