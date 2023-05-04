<div class="w-full">
    <x-auth-card>
        <!-- Logo -->
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-blue-600 dark:fill-slate-200" />
            </a>
        </x-slot>

        <div class="text-center mb-5 md:mb-7">
            <h1 class="text-3xl font-display font-medium tracking-tight text-blue-600 dark:text-slate-200">
                {{ __('Reset your password') }}
            </h1>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors
            class="mb-4 bg-slate-50 border border-slate-200 mb-4 p-4 rounded-md"
            :errors="$errors"
        />

        <form wire:submit.prevent="submit">
            <!-- Email Address -->
            <div>
                <x-label
                    for="email"
                    :value="__('Email')"
                />
                <x-input
                    wire:model.defer="email"
                    id="email"
                    type="email"
                    class="block mt-1 w-full"
                    required
                    autofocus
                />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label
                    for="password"
                    :value="__('Password')"
                />
                <x-input
                    wire:model.defer="password"
                    id="password"
                    type="password"
                    class="block mt-1 w-full"
                    required
                />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label
                    for="password_confirmation"
                    :value="__('Confirm Password')"
                />
                <x-input
                    wire:model.defer="password_confirmation"
                    id="password_confirmation"
                    type="password"
                    class="block mt-1 w-full"
                    required
                />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button.primary class="block w-full">
                    {{ __('Reset Password') }}
                </x-button.primary>
            </div>
        </form>
    </x-auth-card>
</div>
