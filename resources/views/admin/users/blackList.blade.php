<x-admin-layout>
    <x-slot name="header">
        @include('admin.users.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.black_list.process') }}">
                        @csrf
                        <div>
                            <x-input-label for="domain" :value="__('Domain')" />
                            <x-text-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domain')" required autofocus />
                            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="message" :value="__('Message')" />
                            <x-text-input id="message" class="block mt-1 w-full" type="text" name="message" :value="old('message')" required autofocus />
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ms-4">
                                {{ __('Add') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="border-b bg-gray-50">
                        <tr class="divide-x divide-dashed">
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Domain
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Message
                                </span>
                            </th>
                            <th>
                                <span class="flex items-right p-4 pb-2">
                                    Actions
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dashed">
                        @foreach($domains as $domain)
                            <tr class="divide-x divide-dashed">
                                <td class="p-2 px-3 pl-5">
                                    <div class="flex items-center flex-row">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$domain->domain}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 px-3">
                                    {{$domain->message}}
                                </td>
                                <td class="px-4">
                                    <div class="flex w-full justify-center gap-1">
                                        <form method="POST" x-data action="{{ route('admin.users.black_list.delete', [ 'id' => $domain->id ]) }}">
                                            @csrf
                                            <button  @click="if(!confirm('Are you sure to remove {{ $domain->domain}}?')) $event.preventDefault()" class="p-1 bg-red-400 border border-red-300 cursor-pointer text-gray-200 flex-inline rounded-sm text-sm h-8 w-8 text-center">
                                                <i class="fa-solid fa-trash align-middle"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @for ($i = count($domains); $i < 10; $i++)
                            <tr>
                                <td class="p-2 px-3" colspan="5">
                                    <div class="flex-shrink-0 h-10 w-full"></div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    @if($links = $domains->links())
                        <tfoot class="bg-gray-200">
                            <tr>
                                <td colspan="5" class="p-4">
                                    {{ $links }}
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
