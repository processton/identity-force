<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Issued Tokens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('You can keep track of your login history.') }}
        </p>
    </header>

    @foreach ($userAccessTokens as $userAccessToken)
        <div class="mt-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $userAccessToken->name }}
                        <span class="text-xs text-gray-500 dark:text-gray-500">
                            Scope: {{ $userAccessToken->scopes }}
                        </span>
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-500">
                        {{ $userAccessToken->created_at->diffForHumans() }}
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-500">
                        Expires in {{ $userAccessToken->expires_at->diffForHumans() }}
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{ route('tokens.destroy', $userAccessToken->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</section>
