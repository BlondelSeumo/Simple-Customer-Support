<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Collections') }}
        </h1>
        <div class="mt-4 sm:mt-0">
            <x-button.primary
                wire:click="createCollection"
                type="button"
            >
                <x-heroicon-m-plus class="-ml-1 mr-2 w-4 h-4" />
                {{ __('New collection') }}
            </x-button.primary>
        </div>
    </div>

    <div
        x-data="{ showCollectionForm: @entangle('showCollectionForm') }"
        class="mt-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4"
    >
        <x-card
            x-cloak
            x-show="showCollectionForm"
            x-trap="showCollectionForm"
            class="-mx-4 sm:-mx-0 bg-slate-50 dark:bg-slate-700/50"
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

                <form wire:submit.prevent="saveCollection">
                    <fieldset wire:loading.attr="disabled">
                        <div class="flex items-start sm:items-center">
                            <div class="mr-4 flex-shrink-0">
                                <img
                                    src="{{ asset('img/photo-placeholder.png') }}"
                                    alt="{{ __('Upload collection photo') }}"
                                    class="w-12 h-12 rounded"
                                >
                            </div>
                            <div class="flex flex-col w-full sm:flex-row sm:justify-between">
                                <div class="max-w-md w-full mr-4 xl:max-w-2xl">
                                    <div>
                                        <label
                                            for="name"
                                            class="sr-only"
                                        >
                                            {{ __('Collection name') }}
                                        </label>
                                        <input
                                            wire:model.defer="collection.name"
                                            type="text"
                                            id="name"
                                            class="block w-full border-0 border-b border-dotted border-transparent bg-slate-50 font-medium p-0 focus:border-blue-600 focus:ring-0 dark:bg-transparent dark:placeholder-slate-400 dark:text-slate-200 dark:focus:border-blue-500 dark:focus:placeholder-slate-500"
                                            placeholder="{{ __('Collection name') }}"
                                            autocomplete="off"
                                        >
                                    </div>
                                    <div class="mt-1">
                                        <label
                                            for="description"
                                            class="sr-only"
                                        >
                                            {{ __('Optional description') }}
                                        </label>
                                        <input
                                            wire:model.defer="collection.description"
                                            type="text"
                                            id="description"
                                            class="block w-full border-0 border-b border-dotted border-transparent bg-slate-50 p-0 text-sm focus:border-blue-600 focus:ring-0 dark:bg-transparent dark:placeholder-slate-400 dark:text-slate-400 dark:focus:border-blue-500 dark:focus:placeholder-slate-500"
                                            placeholder="{{ __('Optional description') }}"
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                                <div class="space-x-1 sm:self-center">
                                    <x-button.text x-on:click="showCollectionForm = false">
                                        {{ __('Cancel') }}
                                    </x-button.text>
                                    <x-button.primary>
                                        {{ __('Save') }}
                                    </x-button.primary>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </x-slot:content>
        </x-card>

        <x-card class="-mx-4 overflow-hidden sm:-mx-0">
            <x-slot:content>
                <ul
                    wire:sortable="updateCollectionsOrder"
                    role="list"
                    class="-m-4 divide-y divide-slate-300 sm:-m-6 dark:divide-slate-600"
                >
                    @foreach($this->collections as $collection)
                        <li
                            wire:sortable.item="{{ $collection->id }}"
                            wire:key="{{ $collection->id }}"
                            class="bg-white px-4 py-6 sm:px-6 dark:bg-slate-800"
                        >
                            <div class="flex items-start sm:items-center">
                                <div class="flex items-center mr-4 flex-shrink-0 space-x-4">
                                    <button
                                        wire:sortable.handle
                                        class="cursor-grab"
                                    >
                                        <x-heroicon-m-arrows-pointing-out class="w-4 h-4 text-slate-500 dark:text-slate-400" />
                                    </button>
                                    <img
                                        src="{{ $collection->getFirstMediaUrl('icon') }}"
                                        alt="{{ $collection->name }}"
                                        class="w-10 h-10 rounded"
                                    >
                                </div>
                                <div class="flex flex-col w-full sm:flex-row sm:justify-between">
                                    <div class="max-w-md mr-4 text-sm xl:max-w-2xl">
                                        <h4 class="font-medium text-slate-900 sm:truncate dark:text-slate-200">
                                            <a
                                                href="{{ route('agent.collections.details', $collection) }}"
                                                class="hover:text-blue-500 hover:underline dark:hover:text-blue-400"
                                            >
                                                {{ $collection->name }}
                                            </a>
                                        </h4>
                                        <p class="mt-1 text-sm text-slate-500 sm:truncate dark:text-slate-400">
                                            {!! $collection->description ?? __('&mdash; no description') !!}
                                        </p>
                                    </div>
                                    <div class="mt-2 flex self-start border border-slate-300 py-0.5 px-2 rounded-md text-sm text-slate-700 sm:mt-0 sm:self-center dark:border-slate-600 dark:text-slate-400">
                                        <span>{{ trans_choice(':count article|:count articles', $collection->articles_count) }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </x-slot:content>
        </x-card>
    </div>
</div>
