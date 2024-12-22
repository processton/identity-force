<div class="space-x-4">
    <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')" class="px-1 pt-2 pb-3">
        <i class="fa-solid fa-house-chimney"></i>
    </x-nav-link>
    <x-nav-link :href="route('profile.basic')" :active="request()->routeIs('profile.basic')" class="mt-2 pb-2">
        {{ __('Basic profile') }}
    </x-nav-link>
    <x-nav-link :href="route('profile.login_security')" :active="request()->routeIs('profile.login_security')" class="mt-2 pb-2">
        {{ __('Login & Security') }}
    </x-nav-link>
    {{-- <x-nav-link :href="route('profile.notifications')" :active="request()->routeIs('profile.notifications')" class="mt-2 pb-2">
        {{ __('Notifications') }}
    </x-nav-link>
    <x-nav-link :href="route('profile.billing_payments')" :active="request()->routeIs('profile.billing_payments')" class="mt-2 pb-2">
        {{ __('Billing & Payment methods') }}
    </x-nav-link> --}}
</div>
