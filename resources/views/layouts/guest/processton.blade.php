<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-800 antialiased bg-white dark:bg-gray-800">
        <div class="font-[sans-serif]">
            <div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
                <div class="grid md:grid-cols-2 items-center gap-10 max-w-6xl w-full">
                    <div class="h-full">
                        <div class="mb-4">
                            <a href="/">
                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </div>
                        <h2 class="lg:text-3xl text-2xl font-bold text-gray-600">
                            Welcome back
                        </h2>
                        <p class="text-2xl mt-6 text-gray-800">Please enter your username and password.</p>
                        <p class="text-sm mt-6 text-gray-800">Don't have an account <a href="javascript:void(0);" class="text-blue-600 font-semibold hover:underline ml-1">Register here</a></p>
                    </div>

                    <div class="max-w-md md:ml-auto w-full">
                        <div class="w-full sm:max-w-md px-6 pb-4">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
