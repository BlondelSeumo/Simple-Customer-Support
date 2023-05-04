<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Settings') }}
        </h1>
    </div>

    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-agent-settings-navigation wire:ignore />

        <div class="mt-10 space-y-6">
            <!-- Personal Token -->
            <form wire:submit.prevent="savePersonalToken">
                <x-accordion>
                    <x-slot:title>
                        {{ __('Personal token') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Used to perform various backend queries such as product synchronization.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="savePersonalToken, removePersonalToken"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="tokenEnabled"
                                        :value="__('Enable')"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <button
                                            wire:click="$set('tokenEnabled', ! '{{ $tokenEnabled }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Enable Envato personal token') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $tokenEnabled, 'bg-slate-200' => ! $tokenEnabled])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $tokenEnabled, 'translate-x-0' => ! $tokenEnabled])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="tokenEnabled"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="accountToken"
                                        :value="__('Personal token')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="accountToken"
                                            id="accountToken"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="accountToken"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                @if($this->envatoSettings->account_email)
                                    <dl class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                        <dt class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ __('Email') }}</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 dark:text-slate-200">{{ $this->envatoSettings->account_email }}</dd>
                                    </dl>
                                @endif
                                @if($this->envatoSettings->account_username)
                                    <dl class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                        <dt class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ __('Username') }}</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 dark:text-slate-200">{{ $this->envatoSettings->account_username }}</dd>
                                    </dl>
                                @endif
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            @if($this->envatoSettings->token_enabled)
                                <x-button.soft-danger
                                    wire:click="removePersonalToken"
                                    wire:loading.attr="disabled"
                                    class="mr-3"
                                >
                                    {{ __('Disconnect') }}
                                </x-button.soft-danger>
                            @endif
                            <x-button.primary wire:loading.attr="disabled">
                                {{ __('Save changes') }}
                            </x-button.primary>
                        </div>
                    </x-slot:content>
                </x-accordion>
            </form>

            <!-- OAuth Token -->
            <form wire:submit.prevent="saveOAuthCredentials">
                <x-accordion>
                    <x-slot:title>
                        {{ __('OAuth credentials') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Used to allow users of your app to sign in with their Envato Account.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveOAuthCredentials, removeOAuthCredentials"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="oauthEnabled"
                                        :value="__('Enable')"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <button
                                            wire:click="$set('oauthEnabled', !'{{ $oauthEnabled }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Enable Envato integration') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $oauthEnabled, 'bg-slate-200' => ! $oauthEnabled])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $oauthEnabled, 'translate-x-0' => ! $oauthEnabled])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="oauthEnabled"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="oauthClientId"
                                        :value="__('Client ID')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="oauthClientId"
                                            id="oauthClientId"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="oauthClientId"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="oauthClientSecret"
                                        :value="__('Client Secret')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="oauthClientSecret"
                                            id="oauthClientSecret"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="oauthClientSecret"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            @if($this->envatoSettings->oauth_enabled)
                                <x-button.soft-danger
                                    wire:click="removeOAuthCredentials"
                                    wire:loading.attr="disabled"
                                    class="mr-3"
                                >
                                    {{ __('Disconnect') }}
                                </x-button.soft-danger>
                            @endif
                            <x-button.primary wire:loading.attr="disabled">
                                {{ __('Save changes') }}
                            </x-button.primary>
                        </div>
                    </x-slot:content>
                </x-accordion>
            </form>
        </div>
    </div>
</div>
