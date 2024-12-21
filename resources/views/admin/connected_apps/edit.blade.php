<x-admin-layout>
    <x-slot name="header">
        @include('admin.connected_apps.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.connected-apps.edit.process', [ 'id' => $connected_app->id]) }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$connected_app->name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type" :value="__('Type')" />
                            <x-select-input id="type" class="block mt-1 w-full" type="text" name="type" :value="$connected_app->type"  :options="$types" required autofocus />
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="team_id" :value="__('Teams')" />
                            <x-select-input id="team_id" class="block mt-1 w-full" type="text" name="team_id" :value="$connected_app->team_id"  :options="$teams" />
                            <x-input-error :messages="$errors->get('team_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
