<x-guest-processton-layout>
    <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
    </a>
    <h1 class="text-2xl font-semibold text-black text-center">{{ __('Sign up') }}</h1>
    <h2 class="text-sm font-semibold text-gray-500 text-center">{{ __('Join out community') }}</h2>
    @include('auth.processton.socialite')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
         @if (Route::has('login'))
            <div class="mt-4 text-sm text-gray-600 text-center">
                <p>{{ __('Already have an account? ') }}<a href="{{route('login')}}" class="text-black hover:underline">{{ __('Login here') }}</a>
                </p>
            </div>
        @endif
    </form>
</x-guest-processton-layout>
