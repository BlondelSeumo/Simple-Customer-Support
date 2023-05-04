<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Settings') }}
        </h1>
    </div>

    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <x-agent-settings-navigation wire:ignore />

        <div class="mt-10 space-y-6">
            <form wire:submit.prevent="save">
                <x-accordion :expanded="true">
                    <x-slot:title>
                        {{ __('Notification settings') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Here you can configure your notification settings.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="save"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <!-- Notification to admins -->
                                <div class="flex items-start justify-between sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="sendTicketConfirmationToAdmins"
                                        :value="__('When a new ticket is submitted, send a confirmation email to all admins')"
                                        class="sm:col-span-2"
                                    />
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('sendTicketConfirmationToAdmins', ! '{{ $sendTicketConfirmationToAdmins }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Send ticket confirmation to admins') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $sendTicketConfirmationToAdmins, 'bg-slate-200' => ! $sendTicketConfirmationToAdmins])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $sendTicketConfirmationToAdmins, 'translate-x-0' => ! $sendTicketConfirmationToAdmins])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="sendTicketConfirmationToAdmins"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Notification to admins -->
                                <div class="flex items-start justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="sendTicketConfirmationToProductManagers"
                                        :value="__('When a new ticket is submitted, send a confirmation email to all product managers')"
                                        class="sm:col-span-2"
                                    />
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('sendTicketConfirmationToProductManagers', ! '{{ $sendTicketConfirmationToProductManagers }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Send ticket confirmation to product managers') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $sendTicketConfirmationToProductManagers, 'bg-slate-200' => ! $sendTicketConfirmationToProductManagers])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $sendTicketConfirmationToProductManagers, 'translate-x-0' => ! $sendTicketConfirmationToProductManagers])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="sendTicketConfirmationToProductManagers"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Notification to assignees -->
                                <div class="flex items-start justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="sendTicketConfirmationToTicketAssignees"
                                        :value="__('When a new ticket is submitted, send a confirmation email to all ticket assignees')"
                                        class="sm:col-span-2"
                                    />
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('sendTicketConfirmationToTicketAssignees', ! '{{ $sendTicketConfirmationToTicketAssignees }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Send ticket confirmation to ticket assignees') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $sendTicketConfirmationToTicketAssignees, 'bg-slate-200' => ! $sendTicketConfirmationToTicketAssignees])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $sendTicketConfirmationToTicketAssignees, 'translate-x-0' => ! $sendTicketConfirmationToTicketAssignees])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="sendTicketConfirmationToTicketAssignees"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="saved"
                                    class="mr-3"
                                />
                                <x-button.primary wire:loading.attr="disabled">
                                    {{ __('Save changes') }}
                                </x-button.primary>
                            </div>
                        </div>
                    </x-slot:content>
                </x-accordion>
            </form>
        </div>
    </div>
</div>
