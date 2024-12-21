<x-admin-layout>
    <x-slot name="header">
        @include('admin.connected_apps.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4  gap-3 sm:gap-5 not-prose">
                    @foreach ($allowed_method as $method)
                        <a x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-socialite-{{$method['name']}}')"
                            class="relative cursor-pointer flex flex-col items-start justify-between p-6 overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 dark:bg-black bg-white group">
                            <span class="absolute w-full h-full bg-white dark:bg-black inset-0 dark:group-hover:bg-gray-900 group-hover:bg-gray-50 group-hover:bg-opacity-30"></span>
                            <div class="flex items-center justify-between w-full mb-4 ">
                                <i class="relative text-5xl {{$method['icon']}}"></i>
                                <span class="opacity-0 -translate-x-2 flex-shrink-0 group-hover:translate-x-0 py-1 px-2.5 text-[0.6rem] group-hover:opacity-100 transition-all ease-out duration-200 rounded-full bg-gray-50 dark:bg-gray-500 dark:text-white text-gray-500 flex items-center justify-center">
                                    <span>Connect with {{$method['name']}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3 translate-x-0.5 h-3">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                </span>
                            </div>
                            <span class="relative text-xs md:text-sm text-gray-600 dark:text-gray-400">{{$method['description']}}</span>
                        </a>

                        <x-modal name="add-socialite-{{$method['name']}}" focusable>
                            <form method="post" action="{{ route('admin.socialite.update') }}" class="p-6">
                                @csrf

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    <i class="relative text-xl mr-2 {{$method['icon']}}"></i>
                                    {{ __('Configure '.$method['name'].' connection') }}
                                </h2>
                                <input type="hidden" name="method" value="{{$method['method']}}">
                                <div class="mt-4">
                                    <x-input-label for="call_back" :value="__('Callback URL')" />
                                    <x-text-input id="call_back" class="block mt-1 w-full" type="text" name="call_back" :value="route('callback.socialite', ['method'=>$method['method']])" disabled />
                                </div>
                                <div class="mt-4">
                                    <x-input-label :value="__('Place above redirect / callback url into your '.$method['method'].' app.')" />
                                    <x-input-label :value="__('Then click the copy paste below generated client id and secret.')" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="client_id" :value="__('Client Id')" />
                                    <x-text-input id="client_id" class="block mt-1 w-full" type="text" name="client_id" :value="config('config.socialite.'.$method['method'].'.client_id')" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="client_secret" :value="__('Client Secret')" />
                                    <x-text-input id="client_secret" class="block mt-1 w-full" type="text" name="client_secret" :value="config('config.socialite.'.$method['method'].'.client_secret')" />
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-primary-button class="ms-3">
                                        {{ __('Configure') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </x-modal>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
