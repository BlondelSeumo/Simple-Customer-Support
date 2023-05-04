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
                {{ __('Welcome to') }} {{ $generalSettings->site_name ?: config('app.name') }}
            </h1>
            <p class="mt-2 text-slate-500 dark:text-slate-400">
                {{ __('Fill out the form to get started.') }}
            </p>
        </div>

        <form wire:submit.prevent="register">
            <!-- Name -->
            <div>
                <x-label
                    for="name"
                    :value="__('Name')"
                />

                <x-input
                    wire:model.defer="name"
                    id="name"
                    type="text"
                    class="block mt-1 w-full"
                    required
                    autofocus
                />

                <x-input-error
                    for="name"
                    class="mt-2"
                />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
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
                />

                <x-input-error
                    for="email"
                    class="mt-2"
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
                    autocomplete="new-password"
                />

                <x-input-error
                    for="password"
                    class="mt-2"
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

                <x-input-error
                    for="password_confirmation"
                    class="mt-2"
                />
            </div>

            <div class="flex flex-col items-center space-y-2 mt-4">
                <x-button.primary class="block w-full">
                    {{ __('Register') }}
                </x-button.primary>
                <a
                    class="underline text-sm text-slate-600 hover:text-slate-900"
                    href="{{ route('agent.login') }}"
                >
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </x-auth-card>
</div>
