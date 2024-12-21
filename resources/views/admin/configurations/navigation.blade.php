<div class="space-x-4">
    <x-nav-link :href="route('admin.configurations')" :active="request()->routeIs('admin.configurations')" class="mt-2 pb-2">
        {{ __('General') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.configurations.theme')" :active="request()->routeIs('admin.configurations.theme')" class="mt-2 pb-2">
        {{ __('Theme') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.configurations.embed')" :active="request()->routeIs('admin.configurations.embed')" class="mt-2 pb-2">
        {{ __('Embed') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.configurations.teams')" :active="request()->routeIs('admin.configurations.teams')" class="mt-2 pb-2">
        {{ __('Teams') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.configurations.mfa')" :active="request()->routeIs('admin.configurations.mfa')" class="mt-2 pb-2">
        {{ __('MFA') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.configurations.admin-identificaiton')" :active="request()->routeIs('admin.configurations.admin-identificaiton')" class="mt-2 pb-2">
        {{ __('Admin Identification') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.configurations.email-servers')" :active="request()->routeIs('admin.configurations.email-servers')" class="mt-2 pb-2">
        {{ __('Email Servers') }}
    </x-nav-link>

</div>
