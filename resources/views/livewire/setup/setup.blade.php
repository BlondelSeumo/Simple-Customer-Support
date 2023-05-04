<div class="w-full">
    <x-slot:title>
        {{ __('Ticksify Application Setup') }}
    </x-slot:title>

    <x-slot:description>
        {{ __('It looks like this is the first time you are running this application. Please complete the following steps to get started.') }}
    </x-slot:description>

    <div class="max-w-2xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto flex flex-col items-center justify-center">
            <h1 class="font-display font-medium text-3xl text-slate-900">
                {{ __('Ticksify Application Setup') }}
            </h1>
            <p class="mt-2 text-center text-slate-500">
                {{ __('It looks like this is the first time you are running this application. Please complete the following steps to get started.') }}
            </p>
        </div>
        <div class="mt-10">
            <livewire:setup.setup-wizard />
        </div>
    </div>
</div>
