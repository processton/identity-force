<div class="space-x-4">
    <x-nav-link :href="route('admin.teams')" :active="request()->routeIs('admin.teams')" class="mt-2 pb-2">
        {{ __('Teams') }}
    </x-nav-link>
</div>
