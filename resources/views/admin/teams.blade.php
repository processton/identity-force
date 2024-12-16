<x-admin-layout>

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
                                    Members
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center p-4 pb-2">
                                    Subscriptions
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
                        @foreach($teams as $team)
                            <tr class="divide-x divide-dashed">
                                <td class="p-2 px-3 pl-5">
                                    <div class="flex items-center flex-row">
                                        <div class="flex-shrink-0 w-12 border border-gray-100 rounded-full">
                                            <div class="h-10 w-10 rounded-full overflow-hidden border border-white">
                                                <img class="min:h-10 min:w-10 rounded-full" src={{$team->profile_picture_url}} alt={{$team->name}} />
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$team->name}}
                                                @if ($team->gender == 1)
                                                    <i class="fa-solid fa-mars"></i>
                                                @elseif ($team->gender == 2)
                                                    <i class="fa-solid fa-venus"></i>
                                                @else
                                                    <i class="fa-regular fa-circle"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 px-3">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><strong>On: </strong>{{$team->date_of_birth ? $team->date_of_birth : '--/--/----'}}</div>
                                        <div class="text-sm text-gray-500"><strong>Age: </strong>{{$team->age}}</div>
                                        <div class="text-sm text-gray-500"><strong>Birthday In: </strong>{{$team->next_birthday_in}}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><strong>On: </strong>{{$team->last_activity ? $team->last_activity : 'Never'}}</div>
                                        <div class="text-sm text-gray-500"><strong>From: </strong>{{$team->last_ip ? $team->last_ip : '-.-.-.-'}}</div>
                                        <div class="text-sm text-gray-500"><strong>Country: </strong>{{$team->last_country ? $team->last_country : '--'}}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><strong>On: </strong>{{$team->created_at}}</div>
                                        <div class="text-sm text-gray-500"><strong>Since: </strong>{{$team->joined_since}}</div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="flex w-full justify-center gap-1">
                                        <a class="p-1 bg-gray-400 border border-gray-300 cursor-pointer text-gray-600 flex-inline rounded-sm text-sm h-8 w-8 text-center">
                                            <i class="fa-solid fa-eye align-middle"></i>
                                        </a>
                                        <a class="p-1 bg-red-400 border border-red-300 cursor-pointer text-white flex-inline rounded-sm text-sm h-8 w-8 text-center">
                                            <i class="fa-solid fa-ban align-middle"></i>
                                        </a>
                                        <a class="p-1 bg-orange-400 border border-orange-300 cursor-pointer text-gray-600 flex-inline rounded-sm text-sm h-8 w-8 text-center">
                                            <i class="fa-solid fa-envelope-circle-check align-middle"></i>
                                        </a>
                                        <a class="p-1 bg-amber-400 border border-amber-300 cursor-pointer text-gray-800 flex-inline rounded-sm text-sm h-8 w-8 text-center">
                                            <i class="fa-solid fa-passport align-middle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @for ($i = count($teams); $i < 10; $i++)
                            <tr>
                                <td class="p-2 px-3" colspan="5">
                                    <div class="flex-shrink-0 h-10 w-full"></div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    @if($links = $teams->links())
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
