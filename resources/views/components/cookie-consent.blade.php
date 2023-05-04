<div x-data="{ isTemporaryHidden: false, isCookiesAllowed: $persist(false).as('is-cookies-allowed') }">
    <div
        x-cloak
        x-show="!isCookiesAllowed && !isTemporaryHidden"
        class="fixed inset-x-0 bottom-0 pb-2 sm:pb-5"
    >
        <div class="mx-auto max-w-5xl px-2 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-blue-600 p-2 shadow-lg sm:p-3">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex w-0 flex-1 items-center">
                            <span class="flex rounded-lg bg-blue-800 p-2">
                                <x-heroicon-o-megaphone class="h-6 w-6 text-white" />
                            </span>
                        <p class="ml-3 font-medium text-white">
                            {{ $generalSettings->cookie_consent_message }}
                        </p>
                    </div>
                    <div class="order-3 mt-2 w-full flex-shrink-0 sm:order-2 sm:mt-0 sm:w-auto">
                        <button
                            x-on:click="isCookiesAllowed = true"
                            type="button"
                            class="flex w-full items-center justify-center rounded-md border border-transparent bg-white px-4 py-2 text-sm font-medium text-blue-600 shadow-sm hover:bg-blue-50"
                        >
                            {{ $generalSettings->cookie_consent_agree }}
                        </button>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                        <button
                            x-on:click="isTemporaryHidden = true"
                            type="button"
                            class="-mr-1 flex rounded-md p-2 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2"
                        >
                            <span class="sr-only">{{ __('Dismiss') }}</span>
                            <x-heroicon-o-x-mark class="h-6 w-6 text-white" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
