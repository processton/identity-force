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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-0 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            @foreach ([
                'success' => 'bg-lime-100 text-lime-900',
                'error' => 'bg-red-100 text-red-900',
                'warning' => 'bg-yellow-100 text-yellow-900',
                'info' => 'bg-blue-100 text-blue-900',
            ] as $key=> $class )
                @session($key)
                    <div class="w-full {{$class}}">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div x-cloak
                                x-show="showAlert"
                                x-data="{ showAlert: true }"
                                x-init="setTimeout(() => showAlert = false, 120000)"
                                role="alert"
                                class="p-1 flex w-full">
                                <div class="flex-1">{{ $value }}</div>
                                <button @click="showAlert = false" type="button" class="flex-0">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endsession
            @endforeach
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
