<div x-data="basicConfigurationSettings()">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
            <div class="col-span-1">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                        <div class="card-header">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Multi-factor Authentication
                            </h3>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Control your multi-factor authentication policies.
                            </div>
                        </div>
                        <div class="mt-6 space-y-6 scrollable-x-auto pb-3">
                            <table class="table align-middle text-sm text-gray-500 w-full">
                                <tbody class="divide-y divide-dashed">
                                    <tr class="">
                                        <td class="py-2 text-gray-600 font-normal">Policy level</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-select :value="$mfa_policy" field="mfa_policy" :options="json_encode($mfa_policies)" link="{{ route('admin.configurations.update')}}" />
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-checkbox
                                                :value="$mfa_providers_google"
                                                :label="__('Enable google authenticator')"
                                                field="mfa_providers_google"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-checkbox
                                                :value="$mfa_providers_email"
                                                :label="__('Enable email otp')"
                                                field="mfa_providers_email"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-checkbox
                                                :value="$mfa_providers_sms"
                                                :label="__('Enable sms otp')"
                                                field="mfa_providers_sms"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
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
