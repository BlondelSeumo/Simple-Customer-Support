<div>
    <div class="flex items-center justify-center">
        @include('components.setup-wizard-navigation')
    </div>
    <form wire:submit.prevent="save">
        <x-card class="mt-5 relative overflow-hidden">
            <x-slot:header>
                <h2 class="font-display text-lg text-slate-900">
                    {{ __('Admin Credentials') }}
                </h2>
            </x-slot:header>
            <x-slot:content>
                <fieldset
                    wire:loading.class="opacity-50"
                    class="space-y-6 sm:space-y-5"
                >
                    <div>
                        <x-label
                            for="nameInput"
                            :value="__('Name')"
                        />
                        <x-input
                            wire:model.defer="name"
                            id="nameInput"
                            type="text"
                            class="mt-1"
                            :placeholder="__('John Doe')"
                        />
                        <x-input-error
                            for="name"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="emailInput"
                            :value="__('Email')"
                        />
                        <x-input
                            wire:model.defer="email"
                            id="emailInput"
                            type="email"
                            class="mt-1"
                            :placeholder="__('johndoe@example.org')"
                        />
                        <x-input-error
                            for="email"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="passwordInput"
                            :value="__('Password')"
                        />
                        <x-input
                            wire:model.defer="password"
                            id="passwordInput"
                            type="password"
                            class="mt-1"
                            :placeholder="__('********')"
                        />
                        <x-input-error
                            for="password"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="passwordConfirmationInput"
                            :value="__('Confirm password')"
                        />
                        <x-input
                            wire:model.defer="password_confirmation"
                            id="passwordConfirmationInput"
                            type="password"
                            class="mt-1"
                            :placeholder="__('********')"
                        />
                        <x-input-error
                            for="password_confirmation"
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
