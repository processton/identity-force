<x-admin-layout>
    <x-slot name="header">
        @include('admin.users.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="border-b bg-gray-50">
                        <tr class="divide-x divide-dashed">
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Profile
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Date of Birth
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Last Activity
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Timeline
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
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
                        @foreach($users as $user)
                            <tr class="divide-x divide-dashed">
                                <td class="p-2 px-3 pl-5">
                                    <div class="flex items-center flex-row">
                                        <div class="flex-shrink-0 w-12 border border-gray-100 rounded-full">
                                            <div class="h-10 w-10 rounded-full overflow-hidden border border-white">
                                                <img class="min:h-10 min:w-10 rounded-full" src={{$user->profile_picture_url}} alt={{$user->name}} />
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$user->name}}
                                                @if ($user->gender == 1)
                                                    <i class="fa-solid fa-mars"></i>
                                                @elseif ($user->gender == 2)
                                                    <i class="fa-solid fa-venus"></i>
                                                @else
                                                    <i class="fa-regular fa-circle"></i>
                                                @endif
                                            </div>
                                            <div class="text-sm text-gray-500">{{$user->email}}</div>
                                            <div>
                                                @foreach ($user->teams as $team)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{$team->name}}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 px-3">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><strong>On: </strong>{{$user->date_of_birth ? $user->date_of_birth : '--/--/----'}}</div>
                                        <div class="text-sm text-gray-500"><strong>Age: </strong>{{$user->age}}</div>
                                        <div class="text-sm text-gray-500"><strong>Birthday In: </strong>{{$user->next_birthday_in}}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><strong>On: </strong>{{$user->last_activity ? $user->last_activity : 'Never'}}</div>
                                        <div class="text-sm text-gray-500"><strong>From: </strong>{{$user->last_ip ? $user->last_ip : '-.-.-.-'}}</div>
                                        <div class="text-sm text-gray-500"><strong>Country: </strong>{{$user->last_country ? $user->last_country : '--'}}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><strong>On: </strong>{{$user->created_at}}</div>
                                        <div class="text-sm text-gray-500"><strong>Since: </strong>{{$user->joined_since}}</div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="flex w-full justify-center gap-1">
                                        @if(!$user->is_admin)
                                            @if ($user->is_active)
                                                <button
                                                    class="p-1 bg-red-400 border border-red-300 cursor-pointer text-white flex-inline rounded-sm text-sm h-8 w-8 text-center"
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-block-{{$user->id}}')"
                                                >
                                                    <i class="fa-solid fa-ban align-middle"></i>
                                                </button>

                                                <x-modal name="confirm-user-block-{{$user->id}}" focusable>
                                                    <form method="post" action="{{ route('admin.users.block') }}" class="p-6">
                                                        @csrf

                                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                            {{ __('Are you sure you want to delete your account?') }}
                                                        </h2>

                                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                                        </p>
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <div class="mt-6 flex justify-end">
                                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                                {{ __('Cancel') }}
                                                            </x-secondary-button>

                                                            <x-danger-button class="ms-3">
                                                                {{ __('Block Account') }}
                                                            </x-danger-button>
                                                        </div>
                                                    </form>
                                                </x-modal>

                                            @else

                                                <button
                                                    class="p-1 bg-gree-400 border border-gree-300 cursor-pointer text-white flex-inline rounded-sm text-sm h-8 w-8 text-center"
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-unblock-{{$user->id}}')"
                                                >
                                                    <i class="fa-solid fa-ban align-middle"></i>
                                                </button>

                                                <x-modal name="confirm-user-unblock-{{$user->id}}" focusable>
                                                    <form method="post" action="{{ route('admin.users.unblock') }}" class="p-6">
                                                        @csrf

                                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                            {{ __('Are you sure you want to delete your account?') }}
                                                        </h2>

                                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                                        </p>
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <div class="mt-6 flex justify-end">
                                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                                {{ __('Cancel') }}
                                                            </x-secondary-button>

                                                            <x-danger-button class="ms-3">
                                                                {{ __('Block Account') }}
                                                            </x-danger-button>
                                                        </div>
                                                    </form>
                                                </x-modal>


                                            @endif
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @for ($i = count($users); $i < 10; $i++)
                            <tr>
                                <td class="p-2 px-3" colspan="5">
                                    <div class="flex-shrink-0 h-10 w-full"></div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    @if($links = $users->links())
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
