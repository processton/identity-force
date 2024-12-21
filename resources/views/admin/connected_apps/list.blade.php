<x-admin-layout>
    <x-slot name="header">
        @include('admin.connected_apps.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="border-b bg-gray-50">
                        <tr class="divide-x divide-dashed">
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Name
                                </span>
                            </th>
                            <th class="w-24">
                                <span class="flex items-right p-4 pb-2">
                                    Actions
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dashed">
                        @foreach($connected_apps as $app)
                            <tr class="divide-x divide-dashed">
                                <td class="p-2 px-3 pl-5">
                                    <div class="flex items-center flex-row">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$app->name}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="flex w-full justify-end gap-1">
                                        <a
                                        href="{{ route('admin.connected-apps.view', ['id' => $app->id]) }}"
                                        class="p-1 bg-gray-400 border border-gray-300 cursor-pointer text-black flex-inline rounded-sm text-sm h-8 w-8 text-center"
                                        >
                                            <i class="fa-solid fa-eye align-middle"></i>
                                        </a>
                                        <a
                                        href="{{ route('admin.connected-apps.edit', ['id' => $app->id]) }}"
                                        class="p-1 bg-orange-400 border border-orange-300 cursor-pointer text-black flex-inline rounded-sm text-sm h-8 w-8 text-center"
                                        >
                                            <i class="fa-solid fa-pen align-middle"></i>
                                        </a>
                                        <a
                                        href="{{ route('admin.connected-apps.edit', ['id' => $app->id]) }}"
                                        class="p-1 bg-red-400 border border-red-300 cursor-pointer text-black flex-inline rounded-sm text-sm h-8 w-8 text-center"
                                        >
                                            <i class="fa-solid fa-trash align-middle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @for ($i = count($connected_apps); $i < 10; $i++)
                            <tr>
                                <td class="p-2 px-3" colspan="5">
                                    <div class="flex-shrink-0 h-10 w-full"></div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    @if($links = $connected_apps->links())
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
