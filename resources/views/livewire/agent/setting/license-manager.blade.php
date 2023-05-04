<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Settings') }}
        </h1>
    </div>

    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-agent-settings-navigation wire:ignore />

        <div class="mt-10 space-y-6">
            <form wire:submit.prevent="activate">
                <x-accordion :expanded="true">
                    <x-slot:title>
                        {{ __('Registering your license') }}
                    </x-slot:title>

                    <x-slot:description>
                        Enter random value
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            @if($this->isActivated)
                                <dl class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <dt class="text-sm font-medium text-slate-700">{{ __('Purchase code') }}</dt>
                                    <dd class="mt-1 text-sm text-right text-slate-900 sm:col-span-2 sm:mt-0">
                                        {{ \Illuminate\Support\Str::of($this->purchaseCode)->mask('*', -12) }}
                                    </dd>
                                </dl>
                            @else
                                <fieldset
                                    wire:loading.class="opacity-50"
                                    class="space-y-6 sm:space-y-5"
                                >
                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                        <x-label
                                            for="purchaseCodeInput"
                                            :value="__('Purchase code')"
                                            class="sm:mt-px sm:pt-2"
                                        />
                                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                                            <x-input
                                                wire:model.defer="purchaseCode"
                                                id="purchaseCodeInput"
                                                type="text"
                                                :placeholder="\Illuminate\Support\Str::uuid()"
                                            />
                                            <x-input-error
                                                for="purchaseCode"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </fieldset>
                            @endif
                        </div>

                        <div class="mt-6 flex justify-end">
                            @if($this->isActivated)
                                <x-button.danger
                                    wire:click="deactivate"
                                    wire:loading.attr="disabled"
                                    type="button"
                                >
                                    {{ __('Deactivate') }}
                                </x-button.danger>
                            @else
                                <x-button.primary wire:loading.attr="disabled">
                                    {{ __('Activate') }}
                                </x-button.primary>
                            @endif
                        </div>
                    </x-slot:content>
                </x-accordion>
            </form>
        </div>
    </div>
</div>
