<div x-data="basicConfigurationSettings()">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
            <div class="col-span-1">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                        <div class="card-header">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Team Configurations
                            </h3>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                How do you want your teams to be configured?
                            </div>
                        </div>
                        <div class="mt-6 space-y-6 scrollable-x-auto pb-3">
                            <table class="table align-middle text-sm text-gray-500 w-full">
                                <tbody class="divide-y divide-dashed">
                                    <tr class="hover-container">
                                        <td class="py-2 text-gray-800 font-normal text-sm" colspan="2">
                                            <x-editable-checkbox
                                                :value="$teams_enabled"
                                                :label="__('Enable Teams')"
                                                field="teams_enabled"
                                                link="{{ route('admin.configurations.update')}}"
                                            />
                                        </td>
                                    </tr>
                                    @if ($teams_enabled)
                                        <tr>
                                            <td class="py-2 text-gray-600 font-normal">Allowed teams</td>
                                            <td class="py-2 text-gray-800 font-normal text-sm">
                                                <x-editable-input
                                                    :value="$teams_limit_total"
                                                    field="teams_limit_total"
                                                    link="{{ route('admin.configurations.update')}}"
                                                />
                                                <span class="text-xs text-gray-400">Number of teams allowed; 0 for unlimited. </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-gray-600 font-normal">Members per team</td>
                                            <td class="py-2 text-gray-800 font-normal text-sm">
                                                <x-editable-input
                                                    :value="$teams_limit_members"
                                                    field="teams_limit_members"
                                                    link="{{ route('admin.configurations.update')}}"
                                                />
                                                <span class="text-xs text-gray-400">Number of allowed users in one team; 0 for unlimited. </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-gray-600 font-normal">Teams per user</td>
                                            <td class="py-2 text-gray-800 font-normal text-sm">
                                                <x-editable-input
                                                    :value="$teams_limit_per_user"
                                                    field="teams_limit_per_user"
                                                    link="{{ route('admin.configurations.update')}}"
                                                />
                                                <span class="text-xs text-gray-400">Number of teams a user can join; 0 for unlimited. </span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
