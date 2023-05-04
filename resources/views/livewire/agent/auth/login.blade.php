<div class="w-full">
    <x-auth-card>
        <!-- Logo -->
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-blue-600 dark:fill-slate-200" />
            </a>
        </x-slot>

        <!-- Welcome message -->
        <div class="text-center mb-5 md:mb-7">
            <h1 class="text-3xl font-display font-medium tracking-tight text-blue-600 dark:text-slate-200">
                {{ __('Welcome back') }}
            </h1>
            <p class="mt-2 text-slate-500 dark:text-slate-400">
                {{ __('Login to manage your account.') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status
            class="mb-4"
            :status="session('status')"
        />

        <!-- Validation Errors -->
        <x-auth-validation-errors
            class="mb-4"
            :errors="$errors"
        />

        <!-- Main form -->
        <form wire:submit.prevent="login">
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
                <div class="flex items-center justify-between">
                    <x-label
                        for="password"
                        :value="__('Password')"
                    />
                    @if (Route::has('password.request'))
                        <a
                            class="underline text-sm text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-300"
                            href="{{ route('agent.forgot-password') }}"
                            tabindex="-1"
                        >
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <x-input
                    wire:model.defer="password"
                    id="password"
                    type="password"
                    class="block mt-1 w-full"
                    required
                />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <x-label
                    for="remember_me"
                    class="inline-flex items-center"
                >
                    <x-checkbox
                        wire:model.defer="remember_me"
                        id="remember_me"
                    />
                    <span class="ml-2 text-sm text-slate-600 dark:text-slate-200">{{ __('Remember me') }}</span>
                </x-label>
            </div>

            <div class="flex flex-col items-center space-y-2 mt-4">
                <x-button.primary class="block w-full">
                    {{ __('Log in') }}
                </x-button.primary>
            </div>
        </form>
    </x-auth-card>
</div>
