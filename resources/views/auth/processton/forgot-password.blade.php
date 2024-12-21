<x-guest-processton-layout>
    <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
    </a>
    <h1 class="text-2xl font-semibold text-black text-center">{{ __('Forgot password') }}</h1>
    <h2 class="text-sm font-semibold text-gray-500 text-center">{{ __('Enter your email to reset password') }}</h2>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-4 mt-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('login'))
                <a class="text-black text-sm hover:underline" href="{{ route('login') }}">
                    {{ __('Back to login') }}
                </a>
            @endif
            <x-primary-button class="ms-3">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
        @if (Route::has('register') && isset($showRegister) && $showRegister)
            <div class="mt-4 text-sm text-gray-600 text-center">
                <p>{{ __('Seems like you dont have an account?') }} <a href="{{route('register')}}" class="text-black hover:underline">{{ __('Register here') }}</a>
                </p>
            </div>
        @endif
    </form>
</x-guest-processton-layout>
