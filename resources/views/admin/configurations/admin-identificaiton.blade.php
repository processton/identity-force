<x-admin-layout>
    <x-slot name="header">
        @include('admin.configurations.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('admin.configurations.partials.admin-identificaiton')
        </div>
    </div>
</x-admin-layout>
