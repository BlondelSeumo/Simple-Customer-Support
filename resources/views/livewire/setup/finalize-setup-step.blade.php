<div>
    <div class="flex items-center justify-center">
        @include('components.setup-wizard-navigation')
    </div>
    @if($setupFinished)
        <x-card class="mt-5 relative overflow-hidden">
            <x-slot:content>
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <span class="text-3xl">
                            &#127881;
                        </span>
                        <h1 class="font-display text-2xl text-slate-900">
                            {{ __('Setup Complete') }}
                        </h1>
                        <p class="text-slate-700">
                            {{ __('You can now start using the application.') }}
                        </p>
                        <a
                            href="{{ route('agent.dashboard') }}"
                            class="mt-5 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('Go to Dashboard') }}
                        </a>
                    </div>
                </div>
            </x-slot:content>
        </x-card>
    @else
        <x-card class="mt-5 relative overflow-hidden">
            <x-slot:header>
                <h2 class="font-display text-lg text-slate-900">
                    {{ __('Finalizing Setup') }}
                </h2>
            </x-slot:header>
            <x-slot:content>
                <dl class="sm:divide-y sm:divide-slate-200">
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-500">
                            {{ __('Site name') }}
                        </dt>
                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0">
                            {{ $state['general-information-step']['siteName'] ?? '' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-500">
                            {{ __('Site description') }}
                        </dt>
                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0">
                            {{ $state['general-information-step']['siteDescription'] ?? '' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-500">
                            {{ __('Administrator name') }}
                        </dt>
                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0">
                            {{ $state['administrator-account-step']['name'] ?? '' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-500">
                            {{ __('Administrator email') }}
                        </dt>
                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0">
                            {{ $state['administrator-account-step']['email'] ?? '' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-500">
                            {{ __('Administrator password') }}
                        </dt>
                        <dd class="mt-1 italic text-sm text-slate-900 sm:col-span-2 sm:mt-0">
                            {{ __('*hidden for your safety*') }}
                        </dd>
                    </div>
                </dl>
            </x-slot:content>
            <x-slot:footer class="flex items-center justify-end bg-slate-50">
                <x-button.primary wire:click="submit">
                    {{ __('Finish') }}
                </x-button.primary>
            </x-slot:footer>
        </x-card>
    @endif
</div>
