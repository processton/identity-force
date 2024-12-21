<x-admin-layout>
    <x-slot name="header">
        @include('admin.connected_apps.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
                <div class="col-span-1">
                    <div class="grid gap-5 lg:gap-7.5">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                            <div class="card-header">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Connected App
                                </h3>
                            </div>
                            <div class="mt-6 space-y-6 scrollable-x-auto pb-3">
                                <table class="table align-middle text-sm text-gray-500 w-full">
                                    <tbody class="divide-y divide-dashed">
                                        <tr class="hover-container">
                                            <td class="py-2 text-gray-600 font-normal">Name</td>
                                            <td class="py-2 text-gray-800 font-normal text-sm">
                                                {{$connected_app->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-gray-600 font-normal">
                                                Type
                                            </td>
                                            <td class="py-3 text-gray-800 font-normal text-sm" >
                                                {{$connected_app->type}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 xl:grid-cols-1 gap-5 lg:gap-7.5">
                <div class="col-span-1">
                    <div class="grid gap-5 lg:gap-7.5">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                            <div class="card-header flex flex-row">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex-1">
                                    OAuth 2.0 Apps
                                </h3>
                                <button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'new_connected_app')"
                                    class="items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Add OAuth 2.0 App
                                </button>
                            </div>
                            <div class="mt-6 space-y-6 scrollable-x-auto pb-3">
                                <table class="table align-middle text-sm text-gray-500 w-full">
                                    <thead>
                                        <tr>
                                            <th class="py-3 text-gray-600 font-normal text-left w-1/4">ID</th>
                                            <th class="py-3 text-gray-600 font-normal text-left w-1/4">Secret</th>
                                            <th class="py-3 text-gray-600 font-normal text-left w-1/4">Callback</th>
                                            <th class="py-3 text-gray-600 font-normal text-left w-1/4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-dashed">
                                        @forelse ($connected_app->oAuthClients as $oAuthClient)
                                            <tr class="hover-container">
                                                <td class="py-2 text-gray-600 font-normal">{{$oAuthClient->id}}</td>
                                                <td class="py-2 text-gray-600 font-normal">{{$oAuthClient->secret}}</td>
                                                <td class="py-2 text-gray-600 font-normal">{{$oAuthClient->redirect}}</td>
                                                <td class="py-2 text-gray-800 font-normal text-sm text-left">
                                                    <a target="_blank" href="{{ '/oauth/authorize?client_id='.$oAuthClient->id.'&redirect_uri='.$oAuthClient->call_back.'&prompt=none&response_type=code&scope=*&state=123456' }}" class="text-indigo-600 hover:text-indigo-900">
                                                        Test
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="hover-container">
                                                <td class="py-2 text-gray-600 font-normal" colspan="2">
                                                    No OAuth 2.0 Apps found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="new_connected_app" focusable>
        <form method="post" action="{{ route('admin.connected-apps.oauth-client.create') }}" class="p-6">
            @csrf
            <input type="hidden" name="connected_app_id" value="{{$connected_app->id}}">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add OAuth 2.0 App ') }}
            </h2>
            <div class="mt-4">
                <div>
                    <x-input-label for="call_back" :value="__('Callback Url')" />
                    <x-text-input id="call_back" class="block mt-1 w-full" type="text" name="call_back" :value="old('call_back')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Add App') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-admin-layout>
