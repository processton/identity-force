<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
            <div class="col-span-1">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                        <div class="card-header">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Basic Settings
                            </h3>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Manage basic settings for your IDP.
                            </div>
                        </div>
                        <div class="mt-6 space-y-6 scrollable-x-auto pb-3">
                            <table class="table align-middle text-sm text-gray-500">
                                <tbody class="divide-y divide-dashed">
                                    <tr>
                                        <td class="py-2 min-w-28 text-gray-600 font-normal">Logo</td>
                                        <td class="py-2 w-full">
                                            <x-profile-picture :value="$name" link="{{ route('admin.configurations.logo')}}" />
                                        </td>
                                    </tr>
                                    <tr class="hover-container">
                                        <td class="py-2 text-gray-600 font-normal">Name</td>
                                        <td class="py-2 text-gray-800 font-normal text-sm">
                                            <x-editable-input :value="$name" field="name" link="{{ route('admin.configurations.update')}}" />
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
