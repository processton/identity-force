<div >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
            <div class="col-span-1">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                        <div class="card-header">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Email Settings
                            </h3>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Configure your email settings.
                            </div>
                        </div>
                        <div class="mt-6 space-y-6 scrollable-x-auto pb-3">
                            <table class="table align-middle text-sm text-gray-500 w-full">
                                <tbody class="divide-y divide-dashed">
                                    <tr class="hover-container">
                                        <td class="py-2 text-gray-600 font-normal w-1/3">Mailer</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm w-2/3">
                                            <x-editable-select :value="$mailer_driver" field="mailer_driver" :options="json_encode($mailer_drivers)" link="{{ route('admin.configurations.update')}}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600 font-normal">Host</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input
                                                :value="$mailer_host"
                                                field="mailer_host"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600 font-normal">Port</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input
                                                :value="$mailer_port"
                                                field="mailer_port"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600 font-normal">User</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input
                                                :value="$mailer_user"
                                                field="mailer_user"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600 font-normal">Password</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input
                                                :value="$mailer_password"
                                                field="mailer_password"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600 font-normal">Encryption</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input
                                                :value="$mailer_encryption"
                                                field="mailer_encryption"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600 font-normal">From address</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input
                                                :value="$mailer_from_address"
                                                field="mailer_from_address"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600 font-normal">From name</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input
                                                :value="$mailer_from_name"
                                                field="mailer_from_name"
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
