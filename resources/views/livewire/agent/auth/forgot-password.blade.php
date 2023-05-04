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
                {{ __('Forgot your password?') }}
            </h1>
            <p class="mt-2 text-slate-500 dark:text-slate-400">
                {{ __('Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status
            class="mb-4"
            :status="session('status')"
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
                    value="{{ old('email') }}"
                    required
                    autofocus
                />
                <x-input-error
                    for="email"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center center mt-4">
                <x-button.primary class="block w-full">
                    {{ __('Email Password Reset Link') }}
                </x-button.primary>
            </div>
        </form>
    </x-auth-card>
</div>
