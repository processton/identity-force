<x-app-layout>

    @php

        $embedded = request()->routeIs('embed.profile.basic');

    @endphp


    @if(!$embedded)
        <x-slot name="header">
            @include('profile.navigation')
        </x-slot>
    @endif
    <div class="{{ $embedded ? 'p-6' : 'py-12' }}" x-data="basicProfileViewer()">
        <div class="{{ $embedded ? '' : 'max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6' }}">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
                <div class="col-span-1">
                    <div class="grid gap-5 lg:gap-7.5">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
                            <div class="card-header">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Personal Info
                                </h3>
                                <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    View and update your basic profile details to keep your profile up-to-date.
                                </div>
                            </div>
                            <div class="mt-6 space-y-6 scrollable-x-auto pb-3">
                                <table class="table align-middle text-sm text-gray-500">
                                    <tbody class="divide-y divide-dashed">
                                        <tr>
                                            <td class="py-2 min-w-28 text-gray-600 font-normal">Photo</td>
                                            <td class="py-2 w-full">
                                                <x-profile-picture />
                                            </td>
                                        </tr>
                                        <tr class="hover-container">
                                            <td class="py-2 text-gray-600 font-normal">Name</td>
                                            <td class="py-2 text-gray-800 font-normal text-sm">
                                                <x-editable-input :value="$user->name" field="name" link="{{ route('profile.update')}}" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-gray-600 font-normal">
                                                Email
                                            </td>
                                            <td class="py-3 text-gray-800 font-normal text-sm" >
                                                <div x-data="">
                                                    <x-editable-input :value="$user->email" field="email" link="{{ route('profile.update')}}" />
                                                    <span class="text-xs text-gray-400">
                                                        You must verify your email address after changing email.
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-gray-600 font-normal">
                                                Birthday
                                            </td>
                                            <td class="py-3 text-gray-700 text-sm font-normal">
                                                <x-editable-date :value="$user->date_of_birth" field="date_of_birth" link="{{ route('profile.update')}}" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-gray-600 font-normal">
                                                Gender
                                            </td>
                                            <td class="py-3 text-gray-700 text-sm font-normal">
                                                <x-editable-gender :value="$user->gender" field="gender" link="{{ route('profile.update')}}" />
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
</x-app-layout>
<script>

    function basicProfileViewer() {

        console.log("here");
        return {
            name: "<?php echo auth()->user()->name ?>",
            isDirty: false,
            toggleIsDirty() {
                this.isDirty=!this.isDirty
            },
            validateDirt(currentValue, originalValue) {
                this.isOpen=currentValue !== originalValue;
            },
            updateValue(field, newValue) {
                console.log(`Updating ${field} to ${newValue}`);
                this[field] = newValue;
                console.log(this.name);
            }
        }
    }
</script>
