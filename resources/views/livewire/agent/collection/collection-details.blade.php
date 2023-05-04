<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form class="md:flex md:items-center md:justify-between md:space-x-24">
            <fieldset class="flex items-center space-x-5 w-full sm:max-w-sm xl:max-w-3xl">
                <div class="flex-shrink-0">
                    <div class="relative">
                        <div
                            x-data
                            class="relative group"
                        >
                            <img
                                src="{{ $icon ? $icon->temporaryUrl() : $collection->getFirstMediaUrl('icon') }}"
                                alt="{{ __('Collection icon') }}"
                                class="w-12 h-12 rounded"
                            >
                            <x-label
                                for="uploadIconInput"
                                :value="__('Upload icon')"
                                class="hidden"
                            />
                            <x-input
                                wire:model.defer="icon"
                                x-ref="icon"
                                id="uploadIconInput"
                                type="file"
                                class="hidden"
                            />
                            <a
                                x-on:click="$refs.icon.click()"
                                role="button"
                                title="{{ __('Change icon') }}"
                            >
                                <span class="absolute inset-0"></span>
                                <span class="hidden absolute backdrop-blur-sm bg-white/30 bottom-0 justify-center text-slate-600 text-xs w-full group-hover:flex">
                                    {{ __('Change') }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="space-y-1 w-full">
                    <div>
                        <label
                            for="name"
                            class="sr-only"
                        >
                            {{ __('Collection name') }}
                        </label>
                        <input
                            wire:model.lazy="collection.name"
                            type="text"
                            id="name"
                            class="block w-full border-0 border-b border-dotted border-transparent font-display font-medium text-2xl p-0 truncate focus:border-blue-600 focus:ring-0 dark:bg-transparent dark:placeholder-slate-400 dark:text-slate-200 dark:focus:border-blue-500 dark:focus:placeholder-slate-500"
                            placeholder="{{ __('Collection name') }}"
                            autocomplete="off"
                        >
                    </div>
                    <div>
                        <label
                            for="description"
                            class="sr-only"
                        >
                            {{ __('Optional description') }}
                        </label>
                        <input
                            wire:model.lazy="collection.description"
                            type="text"
                            id="description"
                            class="block w-full border-0 border-b border-dotted border-transparent p-0 text-sm truncate focus:border-blue-600 focus:ring-0 dark:bg-transparent dark:placeholder-slate-400 dark:text-slate-400 dark:focus:border-blue-500 dark:focus:placeholder-slate-500"
                            placeholder="{{ __('Optional description') }}"
                            autocomplete="off"
                        >
                    </div>
                </div>
            </fieldset>
            <div x-data="{ confirmingCollectionDeletion: false }">
                <div
                    x-cloak
                    x-show="confirmingCollectionDeletion"
                    class="justify-stretch mt-6 flex flex-shrink-0 flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3"
                >
                    <x-button.text x-on:click="confirmingCollectionDeletion = false">
                        {{ __('Cancel') }}
                    </x-button.text>
                    <x-button.danger
                        wire:click="deleteCollection"
                        type="button"
                    >
                        {{ __('Confirm') }}
                    </x-button.danger>
                </div>
                <div
                    x-show="!confirmingCollectionDeletion"
                    class="justify-stretch mt-6 flex flex-shrink-0 flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3"
                >
                    <x-button.soft-danger x-on:click="confirmingCollectionDeletion = true">
                        {{ __('Delete') }}
                    </x-button.soft-danger>
                    <x-button.primary
                        wire:click="browseArticles"
                        type="button"
                    >
                        {{ __('Add articles') }}
                    </x-button.primary>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($collection->articles->count())
            <ul
                wire:sortable="updateArticlesOrder"
                role="list"
                class="-mx-4 border-b border-t border-slate-200 divide-y divide-slate-200 sm:-mx-0 dark:border-slate-600 dark:divide-slate-600"
            >
                @foreach($collection->articles as $article)
                    <li
                        wire:sortable.item="{{ $article->id }}"
                        wire:key="{{ $article->id }}"
                        class="bg-white py-4 flex items-center justify-between dark:bg-slate-800"
                    >
                        <div class="flex items-center justify-center sm:space-x-5">
                            <div class="flex justify-center w-12 h-auto">
                                <button
                                    wire:sortable.handle
                                    class="cursor-grab"
                                >
                                    <x-heroicon-o-arrows-pointing-out class="w-4 h-4 text-slate-500 dark:text-slate-400" />
                                </button>
                            </div>
                            <div class="flex-1 font-medium text-sm text-slate-900 dark:text-slate-200">
                                <a
                                    href="{{ route('agent.articles.details', $article) }}"
                                    class="hover:text-blue-500 hover:underline dark:hover:text-blue-400"
                                >
                                    {{ $article->title }}
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 justify-center w-12 h-auto">
                            <button
                                wire:click="deleteArticle('{{ $article->id }}')"
                                title="{{ __('Remove article from this collection') }}"
                                class="text-slate-500 transition hover:text-red-500"
                            >
                                <x-heroicon-m-trash class="w-4 h-4" />
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="py-12 border-t border-slate-200 text-center">
                <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-slate-400" />
                <h3 class="mt-2 text-sm font-medium text-slate-900">
                    {{ __('No articles in this collection') }}
                </h3>
                <div class="mt-6">
                    <x-button.primary
                        wire:click="browseArticles"
                        type="button"
                    >
                        {{ __('Add articles') }}
                    </x-button.primary>
                </div>
            </div>
        @endif
    </div>

    <x-dialog-modal wire:model.defer="browsingArticles">
        <x-slot:title>
            {{ __('Add articles to :collection', ['collection' => $collection->name]) }}
        </x-slot:title>
        <x-slot:content>
            <div
                x-data
                class="-mx-4 sm:-mx-6"
            >
                @if(count($unassignedArticles))
                    <ul
                        role="list"
                        class="divide-y divide-slate-200 dark:divide-slate-600"
                    >
                        @foreach($unassignedArticles as $article)
                            <li
                                x-on:click="$refs.checkbox{{ $article->id }}.click()"
                                class="px-4 py-4 flex items-center space-x-5 sm:px-6 hover:bg-slate-100 hover:cursor-pointer dark:hover:bg-slate-600/25"
                            >
                                <div class="flex justify-center">
                                    <x-checkbox
                                        wire:model.lazy="selectedArticles"
                                        x-ref="checkbox{{ $article->id }}"
                                        value="{{ $article->id }}"
                                    />
                                </div>
                                <div class="font-medium text-sm text-slate-900 dark:text-slate-200">
                                    {{ $article->title }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-8 dark:text-slate-400">
                        <p>{{ __('No unassociated articles found.') }}</p>
                    </div>
                @endif
            </div>
        </x-slot:content>
        <x-slot:footer>
            <x-button.primary
                wire:click="addArticles"
                :disabled="!count($selectedArticles)"
            >
                {{ trans_choice('{0} Select article|{1} Add :count article|{2,*} Add :count articles', count($selectedArticles)) }}
            </x-button.primary>
        </x-slot:footer>
    </x-dialog-modal>
</div>
