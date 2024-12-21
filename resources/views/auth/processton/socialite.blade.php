
    @php
        $socialites = array_filter(config('config.socialite'), function($value) {
            return $value['enabled'] == true;
        });
    @endphp


    @if (
        count($socialites) > 0
    )
        <h2 class="text-sm font-semibold text-gray-500 text-center"></h2>
        <div class="mt-4 flex flex-col lg:flex-row items-center justify-between">

            @php
                $width = "w-full lh:w-1/2";
                if (count($socialites) == 1) {
                    $width = "w-full lg:w-full";
                }else if (count($socialites) == 2) {
                    $width = "w-full lg:w-1/2";
                }else if (count($socialites) == 3) {
                    $width = "w-full lg:w-1/3";
                }else if (count($socialites) == 4) {
                    $width = "w-full lg:w-1/4";
                }

                $inOrUp = __('Sign In');

                if (Route::currentRouteName() == 'register') {
                    $inOrUp = __('Sign Up');
                }

            @endphp



            @if(config('config.socialite.google.enabled'))
                <div class="{{ $width }} mb-2 lg:mb-0">
                    <a href="{{route('redirect.to.socialite', ['method' => 'google'])}}" class="w-full flex justify-center items-center gap-2 bg-white text-sm text-gray-600 p-2 rounded-md hover:bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-300">
                        <i class="fa-brands fa-google text-red-600"></i> {{ count(config('config.socialite')) < 3 ? $inOrUp . ' '. __('with Google') : '' }}
                    </a>
                </div>
            @endif
            @if(config('config.socialite.facebook.enabled'))
                <div class="{{ $width }} ml-0 lg:ml-2">
                    <a href="{{route('redirect.to.socialite', ['method' => 'facebook'])}}" class="w-full flex justify-center items-center gap-2 bg-white text-sm text-gray-600 p-2 rounded-md hover:bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-300">
                        <i class="fa-brands fa-facebook text-blue-600"></i> {{ count(config('config.socialite')) < 3 ? $inOrUp . ' '. __('with Facebook') : '' }}
                    </a>
                </div>
            @endif
            @if(config('config.socialite.twitter.enabled'))
                <div class="{{ $width }} ml-0 lg:ml-2">
                    <a href="{{route('redirect.to.socialite', ['method' => 'twitter'])}}" class="w-full flex justify-center items-center gap-2 bg-white text-sm text-gray-600 p-2 rounded-md hover:bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-300">
                        <i class="fa-brands fa-twitter text-blue-400"></i> {{ count(config('config.socialite')) < 3 ? $inOrUp . ' '. __('with Twitter') : '' }}
                    </a>
                </div>
            @endif
            @if(config('config.socialite.linkedin.enabled'))
                <div class="{{ $width }} ml-0 lg:ml-2">
                    <a href="{{route('redirect.to.socialite', ['method' => 'linkedin'])}}" class="w-full flex justify-center items-center gap-2 bg-white text-sm text-gray-600 p-2 rounded-md hover:bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-300">
                        <i class="fa-brands fa-linkedin text-blue-800"></i> {{ count(config('config.socialite')) < 3 ? $inOrUp . ' '. __('with Linkedin') : '' }}
                    </a>
                </div>
            @endif
        </div>
        <div class="mt-4 text-sm text-gray-600 text-center">
            <p>{{ __('or with email') }}</p>
        </div>
    @endif
