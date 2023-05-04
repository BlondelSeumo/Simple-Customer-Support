<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Labels') }}
        </h1>
        <div class="mt-4 sm:mt-0">
            <x-button.primary
                wire:click="createLabel"
                type="button"
            >
                <x-heroicon-m-plus class="-ml-1 mr-2 w-4 h-4" />
                {{ __('New label') }}
            </x-button.primary>
        </div>
    </div>

    <div
        x-data="{ showLabelForm: @entangle('showLabelForm') }"
        class="mt-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
    >
        <div class="space-y-4">
            <x-card
                x-cloak
                x-show="showLabelForm"
                x-trap="showLabelForm"
                class="bg-slate-50 relative rounded-lg overflow-hidden dark:bg-slate-700/50"
            >
                <x-slot:content>
                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <x-heroicon-s-x-circle class="w-5 h-5 text-red-400" />
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        {{ trans_choice('There were :count error with your submission|There were :count errors with your submission', $errors->count()) }}
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul
                                            role="list"
                                            class="list-disc pl-5 space-y-1"
                                        >
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($label)
                        <div class="mb-6">
                            <x-label :value="__('Preview')" />
                            <div class="mt-1 relative inline-flex items-center rounded-full border border-slate-300 hover:border-slate-400 px-3 py-0.5 dark:border-slate-500 dark:hover:border-slate-400">
                                <div class="absolute flex-shrink-0 flex items-center justify-center">
                                    <span
                                        class="h-1.5 w-1.5 rounded-full"
                                        style="background-color: {{ '#'.$label->color }}"
                                        aria-hidden="true"
                                    ></span>
                                </div>
                                <div class="ml-3.5 text-sm font-medium text-slate-900 dark:text-slate-200">
                                    {{ $label->name ?: __('Label preview') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <form wire:submit.prevent="saveLabel">
                        <fieldset
                            wire:loading.attr="disabled"
                            class="grid grid-cols-1 gap-6 sm:grid-cols-12 items-end"
                        >
                            <div class="sm:col-span-4 xl:col-span-3">
                                <x-label
                                    for="label.name"
                                    :value="__('Label name')"
                                />
                                <x-input
                                    wire:model.defer="label.name"
                                    type="text"
                                    class="mt-1"
                                    :placeholder="__('Label name')"
                                />
                            </div>
                            <div class="sm:col-span-5 xl:col-span-4">
                                <x-label
                                    for="label.description"
                                    :value="__('Description')"
                                />
                                <x-input
                                    wire:model.defer="label.description"
                                    type="text"
                                    class="mt-1"
                                    :placeholder="__('Description (optional)')"
                                />
                            </div>
                            <div class="sm:col-span-3 xl:col-span-3">
                                <x-label
                                    for="label.color"
                                    :value="__('Color')"
                                />
                                <div class="mt-1 relative flex items-center">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-slate-500 sm:text-sm">#</span>
                                    </div>
                                    <x-input
                                        wire:model.defer="label.color"
                                        type="text"
                                        class="pl-7 pr-12"
                                    />
                                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                        <button
                                            wire:click="generateLabelColor"
                                            type="button"
                                            class="inline-flex items-center border border-slate-200 rounded px-2 text-sm font-sans font-medium text-slate-400 hover:bg-blue-500 hover:border-blue-500 hover:text-white dark:border-slate-500 dark:hover:border-blue-500"
                                        >
                                            <x-heroicon-o-arrow-path class="w-4 h-4" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-12 xl:col-span-2">
                                <div class="flex items-center justify-end space-x-2">
                                    <x-button.text x-on:click="showLabelForm = false">
                                        {{ __('Cancel') }}
                                    </x-button.text>
                                    <x-button.primary>
                                        {{ __('Save') }}
                                    </x-button.primary>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </x-slot:content>
            </x-card>

            <x-card class="relative rounded-lg overflow-hidden">
                <x-slot:header>
                    <div>
                        <x-input
                            wire:model.debounce.500ms="search"
                            type="search"
                            placeholder="{{ __('Search...') }}"
                        />
                    </div>
                </x-slot:header>
                <x-slot:content>
                    <div class="-mx-4 -my-6 overflow-x-auto sm:-mx-6">
                        <div class="inline-block min-w-full align-middle">
                            <div class="relative overflow-hidden ring-1 ring-black ring-opacity-5">
                                <div
                                    wire:loading.delay
                                    class="absolute inset-0 z-10 bg-slate-100/50 dark:bg-slate-700/50"
                                >
                                    <div
                                        wire:loading.flex
                                        class="h-full w-full items-center justify-center"
                                    >
                                        <div class="m-auto flex items-center space-x-2">
                                            <x-loading-spinner class="w-5 h-5 dark:text-slate-200" />
                                            <p class="text-sm dark:text-slate-200">{{ 'Loading labels...' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <table class="min-w-full divide-y divide-slate-300 dark:divide-slate-600">
                                    <thead class="bg-slate-50 dark:bg-slate-700">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="pl-4 pr-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap sm:pl-6 dark:text-slate-200"
                                            >
                                                {{ __('Name') }}
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap dark:text-slate-200"
                                            >
                                                {{ __('Description') }}
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3 text-center text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap dark:text-slate-200"
                                            >
                                                {{ __('Tickets') }}
                                            </th>
                                            <th
                                                scope="col"
                                                class="relative pl-3 pr-4 py-3 text-right text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-200"
                                            >
                                                <span class="sr-only">
                                                    {{ __('Actions') }}
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-600">
                                        @forelse($this->labels as $label)
                                            <tr wire:loading.class.delay="opacity-50">
                                                <td class="whitespace-nowrap pl-4 pr-3 py-4 font-medium text-sm text-slate-900 sm:pl-6">
                                                    <a
                                                        href="{{ route('agent.tickets.list', ['label' => $label->slug]) }}"
                                                        class="relative inline-flex items-center rounded-full border border-slate-300 px-3 py-0.5 hover:border-slate-400 dark:border-slate-500 dark:hover:border-slate-400"
                                                    >
                                                        <div class="absolute flex-shrink-0 flex items-center justify-center">
                                                            <span
                                                                class="h-1.5 w-1.5 rounded-full"
                                                                style="background-color: {{ '#' . $label->color }}"
                                                                aria-hidden="true"
                                                            ></span>
                                                        </div>
                                                        <div class="ml-3.5 text-sm font-medium text-slate-900 dark:text-slate-200">
                                                            {{ $label->name }}
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-left text-sm text-slate-500 dark:text-slate-400">
                                                    {{ $label->description }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-center text-sm text-slate-500 dark:text-slate-400">
                                                    {{ $label->tickets_count }}
                                                </td>
                                                <td class="whitespace-nowrap pl-3 pr-4 py-4 text-right text-sm text-slate-500 sm:pr-6 dark:text-slate-400">
                                                    <div
                                                        x-data="{ confirmLabelDeletion: false }"
                                                        x-on:click.outside="confirmLabelDeletion = false"
                                                    >
                                                        <div
                                                            x-show="!confirmLabelDeletion"
                                                            class="space-x-1"
                                                        >
                                                            <button
                                                                wire:click="editLabel({{ $label->id }})"
                                                                type="button"
                                                                title="{{ __('Edit label') }}"
                                                                class="hover:text-blue-500"
                                                            >
                                                                <x-heroicon-m-pencil-square class="h-4 w-4" />
                                                                <span class="sr-only">{{ __('Edit') }}</span>
                                                            </button>
                                                            <button
                                                                x-on:click="confirmLabelDeletion = true"
                                                                type="button"
                                                                title="{{ __('Delete label') }}"
                                                                class="hover:text-red-500"
                                                            >
                                                                <x-heroicon-m-trash class="h-4 w-4" />
                                                                <span class="sr-only">{{ __('Delete') }}</span>
                                                            </button>
                                                        </div>
                                                        <div
                                                            x-cloak
                                                            x-show="confirmLabelDeletion"
                                                            class="space-x-1"
                                                        >
                                                            <button
                                                                x-on:click="confirmLabelDeletion = false"
                                                                type="button"
                                                                title="{{ __('Cancel') }}"
                                                                class="text-blue-600 hover:text-blue-500 dark:hover:text-blue-400"
                                                            >
                                                                <x-heroicon-m-x-circle class="h-4 w-4" />
                                                                <span class="sr-only">{{ __('Cancel') }}</span>
                                                            </button>
                                                            <button
                                                                wire:click="deleteLabel('{{ $label->id }}')"
                                                                x-on:click="confirmLabelDeletion = false"
                                                                type="button"
                                                                title="{{ __('Confirm') }}"
                                                                class="text-red-600 hover:text-red-500 dark:hover:text-red-400"
                                                            >
                                                                <x-heroicon-m-check-circle class="h-4 w-4" />
                                                                <span class="sr-only">{{ __('Confirm') }}</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr wire:loading.class.delay="opacity-50">
                                                <td
                                                    colspan="4"
                                                    class="px-3 py-8 text-center text-slate-500 dark:text-slate-400"
                                                >
                                                    <div class="inline-flex items-center space-x-1">
                                                        <x-heroicon-o-inbox class="w-5 h-5 text-slate-400" />
                                                        <span>{{ __('No records found...') }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </x-slot:content>
                @if($this->labels->hasPages())
                    <x-slot:footer>
                        {{ $this->labels->links() }}
                    </x-slot:footer>
                @endif
            </x-card>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('message.sent', () => {
                    window.dispatchEvent(new CustomEvent('loading', {detail: {loading: true}}));
                });
                Livewire.hook('message.processed', () => {
                    window.dispatchEvent(new CustomEvent('loading', {detail: {loading: false}}));
                });
            });
        </script>
    @endpush
</div>
