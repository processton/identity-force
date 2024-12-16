<div class="space-x-4">
    <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="mt-2 pb-2">
        {{ __('List') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.users.invite')" :active="request()->routeIs('admin.users.invite')" class="mt-2 pb-2">
        {{ __('Invite User') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.users.blocked')" :active="request()->routeIs('admin.users.blocked')" class="mt-2 pb-2">
        {{ __('Blocked') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.users.black_list')" :active="request()->routeIs('admin.users.black_list')" class="mt-2 pb-2">
        {{ __('Black-List') }}
    </x-nav-link>
</div>
