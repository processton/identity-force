<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Session') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('You can keep track of your login history.') }}
        </p>
    </header>

    @foreach ($userSessions as $userSession)
        <div class="mt-4 border rounded-md p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $userSession->ip_address }}
                        @if(session()->getId() == $userSession->id)
                            <span class="text-xs text-gray-500 dark:text-gray-500">
                                ({{ __('Current session') }})
                            </span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-500">
                            {{ $userSession->user_agent }}
                        </span>
                    <div class="text-xs text-gray-500 dark:text-gray-500">
                        {{ \Carbon\Carbon::createFromTimestamp($userSession->last_activity)->diffForHumans() }}
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{ route('sessions.destroy', $userSession->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit" class="text-red-600 dark:text-red-400">
                            {{ __('Logout') }}
                        </x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</section>
