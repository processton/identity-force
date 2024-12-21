<x-app-layout>
    <x-slot name="header">
        @include('profile.navigation')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 lg:gap-7.5">
                <a class="bg-white shadow-sm hover:shadow-md rounded-sm p-5 lg:p-7.5 lg:pt-7" href="{{ route('profile.basic')}}">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-3">
                            <i class="fa-solid fa-id-card text-gray-600 text-2xl link">
                            </i>
                        </div>
                        <div class="flex flex-col gap-3">
                            <span class="text-base font-medium leading-none text-gray-900 hover:underline">
                                Basic profile
                            </span>
                            <span class="text-2sm text-gray-700 leading-5">
                                View and update your basic profile details to keep your profile up-to-date.
                            </span>
                        </div>
                    </div>
                </a>
                <a class="bg-white shadow-sm hover:shadow-md rounded-sm p-5 lg:p-7.5 lg:pt-7" href="{{ route('profile.login_security')}}">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-3">
                            <i class="fa-solid fa-shield text-gray-600 text-2xl link">
                            </i>
                        </div>
                        <div class="flex flex-col gap-3">
                            <span class="text-base font-medium leading-none text-gray-900 hover:underline">
                                Login &amp; Security
                            </span>
                            <span class="text-2sm text-gray-700 leading-5">
                                Keep your account safe. Update your login credentials, review security settings, and protect your data with enhanced security options.
                            </span>
                        </div>
                    </div>
                </a>
                <a class="bg-white shadow-sm hover:shadow-md rounded-sm p-5 lg:p-7.5 lg:pt-7" href="{{ route('profile.notifications')}}">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-3">
                            <i class="fa-solid fa-bell text-gray-600 text-2xl link">
                            </i>
                        </div>
                        <div class="flex flex-col gap-3">
                            <span class="text-base font-medium leading-none text-gray-900 hover:underline">
                                Notifications
                            </span>
                            <span class="text-2sm text-gray-700 leading-5">
                                Stay informed with updates that matter. Manage your notification preferences and choose how you’d like to receive alerts about activity, updates, and reminders.
                            </span>
                        </div>
                    </div>
                </a>
                <a class="bg-white shadow-sm hover:shadow-md rounded-sm p-5 lg:p-7.5 lg:pt-7" href="{{ route('profile.billing_payments')}}">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-3">
                            <i class="fa-solid fa-file-invoice text-gray-600 text-2xl link">
                            </i>
                        </div>
                        <div class="flex flex-col gap-3">
                            <span class="text-base font-medium leading-none text-gray-900 hover:underline">
                                Billing &amp; Payment methods
                            </span>
                            <span class="text-2sm text-gray-700 leading-5">
                                Access your billing history, payment options, and subscription details all in one place. Click here to ensure everything's up to date.
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
