<div class="space-x-4">
    <x-nav-link :href="route('admin.connected-apps')" :active="request()->routeIs('admin.connected-apps')" class="mt-2 pb-2">
        {{ __('Apps') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.socialite')" :active="request()->routeIs('admin.socialite')" class="mt-2 pb-2">
        {{ __('Socialites') }}
    </x-nav-link>
</div>
