<div class="space-x-4">
    <x-nav-link :href="route('admin.oauth')" :active="request()->routeIs('admin.oauth')" class="mt-2 pb-2">
        {{ __('OAuth 2.0') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.saml')" :active="request()->routeIs('admin.saml')" class="mt-2 pb-2">
        {{ __('SAML') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.socialite')" :active="request()->routeIs('admin.socialite')" class="mt-2 pb-2">
        {{ __('Socialites') }}
    </x-nav-link>
</div>
