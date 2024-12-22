<x-app-layout>
    @php

        $embedded = request()->routeIs('embed.profile.login_security');

    @endphp


    @if(!$embedded)
        <x-slot name="header">
            @include('profile.navigation')
        </x-slot>
    @endif

    <div class="{{ $embedded ? 'p-6' : 'py-12' }}" x-data="basicProfileViewer()">
        <div class="{{ $embedded ? '' : 'max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6' }}">
            <div class="grid grid-cols-1 gap-5 lg:gap-7.5">
                <div class="col-span-1">
                    <div class="grid gap-5 lg:gap-7.5">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                            <div class="card-header">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Login &amp; Security
                                </h3>
                                <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Keep your account safe. Update your login credentials, review security settings, and protect your data with enhanced security options.
                                </div>
                            </div>
                            <div class="grid grid-cols-1 xl:grid-cols-2 mt-6 gap-6 scrollable-x-auto pb-3">
                                <div class="space-y-6">
                                    @include('profile.partials.user-sessions-list')
                                    @include('profile.partials.user-tokens-list')
                                </div>
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
