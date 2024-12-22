<x-guest-layout>

    @php

        $embedded = request()->routeIs('embed.login');

    @endphp
    <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
    </a>
    <h1 class="text-2xl font-semibold text-black text-center">{{ __('Sign In') }}</h1>
    @include('auth.processton.socialite')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-black text-sm hover:underline" href="{{ $embedded ? route('embed.password.request') : route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
         @if (Route::has('register'))
            <div class="mt-4 text-sm text-gray-600 text-center">
                <p>{{ __('Dont have an account?') }} <a href="{{ $embedded ? route('embed.register') : route('register') }}" class="text-black hover:underline">{{ __('Register here') }}</a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>
