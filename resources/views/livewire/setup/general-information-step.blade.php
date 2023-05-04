<div>
    <div class="flex items-center justify-center">
        @include('components.setup-wizard-navigation')
    </div>
    <form wire:submit.prevent="save">
        <x-card class="mt-5 relative overflow-hidden">
            <x-slot:header>
                <h2 class="font-display text-lg text-slate-900">
                    {{ __('Application Information') }}
                </h2>
            </x-slot:header>
            <x-slot:content>
                <fieldset
                    wire:loading.class="opacity-50"
                    class="space-y-6 sm:space-y-5"
                >
                    <div>
                        <x-label
                            for="siteNameInput"
                            :value="__('Name')"
                        />
                        <x-input
                            wire:model.defer="siteName"
                            id="siteNameInput"
                            type="text"
                            class="mt-1"
                        />
                        <x-input-error
                            for="siteName"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="siteDescriptionInput"
                            :value="__('Description')"
                        />
                        <x-textarea
                            wire:model.defer="siteDescription"
                            id="siteDescriptionInput"
                            type="text"
                            class="mt-1"
                        />
                        <x-input-error
                            for="siteDescription"
                            class="mt-2"
                        />
                    </div>
                </fieldset>
            </x-slot:content>
            <x-slot:footer class="flex items-center justify-end bg-slate-50">
                <x-button.primary class="group">
                    {{ __('Next step') }}
                    <svg
                        class="mt-0.5 ml-2 -mr-1 stroke-white stroke-2"
                        fill="none"
                        width="10"
                        height="10"
                        viewBox="0 0 10 10"
                        aria-hidden="true"
                    >
                        <path
                            class="opacity-0 transition group-hover:opacity-100"
                            d="M0 5h7"
                        ></path>
                        <path
                            class="transition group-hover:translate-x-[3px]"
                            d="M1 1l4 4-4 4"
                        ></path>
                    </svg>
                </x-button.primary>
            </x-slot:footer>
        </x-card>
    </form>
</div>
