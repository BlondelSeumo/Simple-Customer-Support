<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Settings') }}
        </h1>
    </div>

    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <x-agent-settings-navigation wire:ignore />

        <div class="mt-10 space-y-6">
            <!-- Information -->
            <form wire:submit.prevent="saveGeneralInformation">
                <x-accordion>
                    <x-slot:title>
                        {{ __('General information') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Manage how information is displayed on your site.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:sm:border-slate-600">
                            <fieldset
                                wire:target="saveGeneralInformation"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="siteNameInput"
                                        :value="__('Site name')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="siteName"
                                            id="siteNameInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="siteName"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="siteDescriptionInput"
                                        :value="__('Site description')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="siteDescription"
                                            id="siteDescriptionInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="siteDescription"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="siteLogoInput"
                                        :value="__('Site logo')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div
                                        x-data
                                        class="mt-1 flex text-sm text-slate-900 sm:col-span-2 sm:mt-0"
                                    >
                                        <div class="flex-grow">
                                            <img
                                                src="{{ $logoFile ? $logoFile->temporaryUrl() : ($logoPath ? Storage::url($logoPath) : asset('img/logo-white-full.png')) }}"
                                                alt="{{ __('Site logo') }}"
                                                @class(['px-2 py-1 inline-block h-10 w-auto rounded-md', 'bg-blue-600' => !$logoPath || !$logoFile])
                                            >
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0 items-start space-x-4 sm:mt-px sm:pt-2">
                                            <x-input
                                                wire:model="logoFile"
                                                x-ref="photo"
                                                id="siteLogoInput"
                                                type="file"
                                                class="hidden"
                                            />
                                            <button
                                                x-on:click.prevent="$refs.photo.click();"
                                                type="button"
                                                class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-blue-400 dark:hover:underline dark:focus:ring-offset-slate-800"
                                            >
                                                {{ __('Change') }}
                                            </button>
                                            @if($logoPath)
                                                <span
                                                    class="text-slate-300 dark:text-slate-500"
                                                    aria-hidden="true"
                                                >|</span>
                                                <button
                                                    x-on:click="$wire.removeLogo()"
                                                    type="button"
                                                    class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-blue-400 dark:hover:underline dark:focus:ring-offset-slate-800"
                                                >
                                                    {{ __('Remove') }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="siteFaviconInput"
                                        :value="__('Site favicon')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div
                                        x-data
                                        class="mt-1 flex text-sm text-slate-900 sm:col-span-2 sm:mt-0"
                                    >
                                        <div class="flex-grow">
                                            <img
                                                src="{{ $faviconFile ? $faviconFile->temporaryUrl() : ($faviconPath ? Storage::url($faviconPath) : asset('img/logo-blue.png')) }}"
                                                alt="{{ __('Site favicon') }}"
                                                class="inline-block h-10 w-auto"
                                            >
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0 items-start space-x-4 sm:mt-px sm:pt-2">
                                            <x-input
                                                wire:model="faviconFile"
                                                x-ref="photo"
                                                id="siteFaviconInput"
                                                type="file"
                                                class="hidden"
                                            />
                                            <button
                                                x-on:click.prevent="$refs.photo.click();"
                                                type="button"
                                                class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-blue-400 dark:hover:underline dark:focus:ring-offset-slate-800"
                                            >
                                                {{ __('Change') }}
                                            </button>
                                            @if($faviconPath)
                                                <span
                                                    class="text-slate-300"
                                                    aria-hidden="true"
                                                >|</span>
                                                <button
                                                    x-on:click="$wire.removeFavicon()"
                                                    type="button"
                                                    class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-blue-400 dark:hover:underline dark:focus:ring-offset-slate-800"
                                                >
                                                    {{ __('Remove') }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="general-information-settings-saved"
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

            <!-- Announcement -->
            <form wire:submit.prevent="saveAnnouncementSettings">
                <x-accordion>
                    <x-slot:title>
                        {{ __('Announcement') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Manage how announcement is displayed.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveAnnouncementSettings"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="announcementEnabled"
                                        :value="__('Enable')"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <button
                                            wire:click="$set('announcementEnabled', ! '{{ $announcementEnabled }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Enable announcement') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $announcementEnabled, 'bg-slate-200' => ! $announcementEnabled])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $announcementEnabled, 'translate-x-0' => ! $announcementEnabled])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="announcementEnabled"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="announcementMessage"
                                        :value="__('Message')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            id="announcementMessage"
                                            wire:model.defer="announcementMessage"
                                            type="text"
                                            class="block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        />
                                        <x-input-error
                                            for="announcementMessage"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="announcementLink"
                                        :value="__('Link')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            id="announcementLink"
                                            wire:model.defer="announcementLink"
                                            type="text"
                                            class="block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        />
                                        <x-input-error
                                            for="announcementLink"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="announcementLinkText"
                                        :value="__('Link text')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            id="announcementLinkText"
                                            wire:model.defer="announcementLinkText"
                                            type="text"
                                            class="block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        />
                                        <x-input-error
                                            for="announcementLinkText"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="announcement-settings-saved"
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

            <!-- Cookie consent -->
            <form wire:submit.prevent="saveCookieConsentSettings">
                <x-accordion>
                    <x-slot:title>
                        {{ __('Cookie consent') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Manage how cookie data collection notice is displayed.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveCookieConsentSettings"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="cookieConsentEnabled"
                                        :value="__('Enable')"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <button
                                            wire:click="$set('cookieConsentEnabled', ! '{{ $cookieConsentEnabled }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Enable cookie consent notice') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $cookieConsentEnabled, 'bg-slate-200' => ! $cookieConsentEnabled])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $cookieConsentEnabled, 'translate-x-0' => ! $cookieConsentEnabled])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="cookieConsentEnabled"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="cookieConsentMessageInput"
                                        :value="__('Message')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="cookieConsentMessage"
                                            id="cookieConsentMessageInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="cookieConsentMessage"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="cookieConsentAgreeInput"
                                        :value="__('Agree')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="cookieConsentAgree"
                                            id="cookieConsentAgreeInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="cookieConsentAgree"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="cookie-consent-settings-saved"
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

            <!-- User sign-up -->
            <form wire:submit.prevent="saveUserRegistrationSettings">
                <x-accordion>
                    <x-slot:title>
                        {{ __('Allow user registration') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('If you disable this, you will need to manually create new users.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveUserRegistrationSettings"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="enableUserRegistration"
                                        :value="__('Enable')"
                                        class=
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <button
                                            wire:click="$set('enableUserRegistration', ! '{{ $enableUserRegistration }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Enable cookie consent notice') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $enableUserRegistration, 'bg-slate-200' => ! $enableUserRegistration])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $enableUserRegistration, 'translate-x-0' => ! $enableUserRegistration])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="enableUserRegistration"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="user-registration-settings-saved"
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

            <!-- ReCaptcha -->
            <form wire:submit.prevent="saveReCaptchaSettings">
                <x-accordion>
                    <x-slot:title>
                        {{ __('ReCaptcha') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Enable Google ReCaptcha v3 for user Login or Registration.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveReCaptchaSettings"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="reCaptchaEnabled"
                                        :value="__('Enable')"
                                        class=
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <button
                                            wire:click="$set('reCaptchaEnabled', ! '{{ $reCaptchaEnabled }}')"
                                            type="button"
                                            class="group relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
                                            role="switch"
                                            aria-checked="false"
                                        >
                                            <span class="sr-only">{{ __('Enable cookie consent notice') }}</span>
                                            <span
                                                aria-hidden="true"
                                                class="pointer-events-none absolute h-full w-full rounded-md"
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out', 'bg-blue-600' => $reCaptchaEnabled, 'bg-slate-200' => ! $reCaptchaEnabled])
                                            ></span>
                                            <span
                                                aria-hidden="true"
                                                @class(['pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-slate-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out', 'translate-x-5' => $reCaptchaEnabled, 'translate-x-0' => ! $reCaptchaEnabled])
                                            ></span>
                                        </button>
                                        <x-input-error
                                            for="reCaptchaEnabled"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="reCaptchaSiteKeyInput"
                                        :value="__('Site Key')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="reCaptchaSiteKey"
                                            id="reCaptchaSiteKeyInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="reCaptchaSiteKey"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>

                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="reCaptchaSecretKeyInput"
                                        :value="__('Site Secret')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="reCaptchaSecretKey"
                                            id="reCaptchaSecretKeyInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="reCaptchaSecretKey"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="re-captcha-settings-saved"
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
