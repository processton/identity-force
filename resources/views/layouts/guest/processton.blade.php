<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('config.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-800 antialiased bg-white dark:bg-gray-800">
        <div class="flex h-screen">
            <!-- Left Pane -->
            <div style="background-image: url('{{ asset('moon.svg') }}')" class="hidden bg-cover bg-center bg-no-repeat lg:flex items-center justify-center flex-1 bg-white text-black">
                <div class="max-w-md text-center">
                </div>
            </div>
            <!-- Right Pane -->
            <div class="w-full bg-gray-100 lg:w-1/2 flex items-center justify-center">
                <div class="max-w-md w-full p-6 space-y-6">
                    {{ $slot }}
                </div>
            </div>
            </div>
    </body>
</html>
