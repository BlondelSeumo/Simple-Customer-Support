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
                        {{ __('Ticket settings') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Manage custom settings for ticket.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="save"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <!-- Assignment to admins -->
                                <div class="flex items-start justify-between sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="allowAssignmentToAdmins"
                                        :value="__('Allow ticket assignment to admins')"
                                        class="sm:col-span-2"
                                    />
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('allowAssignmentToAdmins', ! '{{ $allowAssignmentToAdmins }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Allow ticket assignment to admins') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $allowAssignmentToAdmins, 'bg-slate-200' => ! $allowAssignmentToAdmins])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $allowAssignmentToAdmins, 'translate-x-0' => ! $allowAssignmentToAdmins])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="allowAssignmentToAdmins"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Assignment to others -->
                                <div class="flex items-start justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="allowAgentToAssignTicket"
                                        :value="__('Allow agent to assign ticket to another agents')"
                                        class="sm:col-span-2"
                                    />
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('allowAgentToAssignTicket', ! '{{ $allowAgentToAssignTicket }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Allow agent to assign ticket to another agents') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $allowAgentToAssignTicket, 'bg-slate-200' => ! $allowAgentToAssignTicket])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $allowAgentToAssignTicket, 'translate-x-0' => ! $allowAgentToAssignTicket])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="allowAgentToAssignTicket"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Self-resign from assigned ticket -->
                                <div class="flex items-start justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <div class="sm:col-span-2">
                                        <x-label
                                            for="allowAgentToResignTicket"
                                            :value="__('Allow agent to self-resign from assigned ticket')"
                                        />
                                        <x-input-error
                                            for="allowAgentToResignTicket"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('allowAgentToResignTicket', ! '{{ $allowAgentToResignTicket }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Allow agent to self-resign from assigned ticket') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $allowAgentToResignTicket, 'bg-slate-200' => ! $allowAgentToResignTicket])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $allowAgentToResignTicket, 'translate-x-0' => ! $allowAgentToResignTicket])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="allowAgentToResignTicket"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Toggle auto assignment -->
                                <div class="flex items-start justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="autoAssignmentEnabled"
                                        :value="__('Auto assignment enabled')"
                                        class="sm:col-span-2"
                                    />
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('autoAssignmentEnabled', ! '{{ $autoAssignmentEnabled }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Enable ticket auto assignment') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $autoAssignmentEnabled, 'bg-slate-200' => ! $autoAssignmentEnabled])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $autoAssignmentEnabled, 'translate-x-0' => ! $autoAssignmentEnabled])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="autoAssignmentEnabled"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Toggle auto assignment -->
                                <div class="flex items-start justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="autoAssignmentUseRandomAgent"
                                        :value="__('Auto assignment use a random agent')"
                                        class="sm:col-span-2"
                                    />
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('autoAssignmentUseRandomAgent', ! '{{ $autoAssignmentUseRandomAgent }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Allow agent to assign ticket to another agents') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $autoAssignmentUseRandomAgent, 'bg-slate-200' => ! $autoAssignmentUseRandomAgent])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $autoAssignmentUseRandomAgent, 'translate-x-0' => ! $autoAssignmentUseRandomAgent])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="autoAssignmentUseRandomAgent"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Allow agent to see license code -->
                                <div class="flex items-start justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <div class="sm:col-span-2">
                                        <x-label
                                            for="allowAgentToSeeLicenseCode"
                                            :value="__('Allow agent to see license code')"
                                        />
                                        <x-input-error
                                            for="allowAgentToSeeLicenseCode"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div class="mt-1 sm:mt-0 text-left sm:text-right">
                                        <button
                                            wire:click="$set('allowAgentToSeeLicenseCode', ! '{{ $allowAgentToSeeLicenseCode }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Allow agent to see license code') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $allowAgentToSeeLicenseCode, 'bg-slate-200' => ! $allowAgentToSeeLicenseCode])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $allowAgentToSeeLicenseCode, 'translate-x-0' => ! $allowAgentToSeeLicenseCode])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="allowAgentToSeeLicenseCode"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <!-- Maximum number of comments per page -->
                                <div class="flex items-center justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <div class="sm:col-span-2">
                                        <x-label
                                            for="maxCommentsPerPage"
                                            :value="__('Maximum number of comments per page')"
                                        />
                                        <x-input-error
                                            for="maxCommentsPerPage"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div class="mt-1 flex justify-end sm:mt-0">
                                        <x-input
                                            wire:model.defer="maxCommentsPerPage"
                                            id="maxCommentsPerPage"
                                            type="number"
                                            min="1"
                                            max="9999"
                                            class="!w-24 input-no-spinners"
                                        />
                                    </div>
                                </div>

                                <!-- Maximum attachment upload size -->
                                <div class="flex items-center justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <div class="sm:col-span-2">
                                        <x-label
                                            for="maxAttachmentUploadSize"
                                            :value="__('Maximum attachment upload size (Megabytes)')"
                                        />
                                        <x-input-error
                                            for="maxAttachmentUploadSize"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div class="mt-1 flex justify-end sm:mt-0">
                                        <x-input
                                            wire:model.defer="maxAttachmentUploadSize"
                                            id="maxAttachmentUploadSize"
                                            type="number"
                                            min="1"
                                            class="!w-24 input-no-spinners"
                                        />
                                    </div>
                                </div>

                                <!-- Maximum image upload size -->
                                <div class="flex items-center justify-between sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <div class="sm:col-span-2">
                                        <x-label
                                            for="maxImageUploadSize"
                                            :value="__('Maximum image upload size (Megabytes)')"
                                        />
                                        <x-input-error
                                            for="maxImageUploadSize"
                                            class="mt-2"
                                        />
                                    </div>
                                    <div class="mt-1 flex justify-end sm:mt-0">
                                        <x-input
                                            wire:model.defer="maxImageUploadSize"
                                            id="maxImageUploadSize"
                                            type="number"
                                            min="1"
                                            class="!w-24 input-no-spinners"
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
