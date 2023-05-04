<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Article details') }}
        </h1>
        <div class="justify-stretch mt-6 flex flex-shrink-0 flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
            <x-button.secondary
                wire:click="$set('showSettings', true)"
                type="button"
            >
                {{ __('Settings') }}
            </x-button.secondary>
            <x-button.primary
                wire:click="save"
                type="button"
            >
                {{ __('Save') }}
            </x-button.primary>
        </div>
    </div>

    <div class="mt-6 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="pt-8 border-t border-slate-200 space-y-4 dark:border-slate-600">
            @if ($errors->has('article.content'))
                <div class="rounded-md bg-red-50 p-4">
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
            <div x-data="{ content: @entangle('article.title')}">
                <div
                    x-on:blur="content = $event.target.innerHTML"
                    contenteditable="true"
                    class="block w-full border-0 border-b border-dotted border-transparent font-display font-medium text-5xl text-center p-0 focus:border-blue-600 focus:outline-none dark:bg-transparent dark:placeholder-slate-400 dark:text-slate-200 dark:focus:border-blue-400 dark:focus:placeholder-slate-500"
                >
                    {{ $article->title }}
                </div>
            </div>
            <div class="pt-4">
                <x-tiptap wire:model.defer="article.content" />
            </div>
        </div>
    </div>

    <x-slide-over-panel wire:model.defer="showSettings">
        <x-slot:title>
            {{ __('Article settings') }}
        </x-slot:title>
        <x-slot:content>
            <div class="divide-y divide-slate-200 dark:divide-slate-600">
                <div class="space-y-6">
                    <div>
                        <x-label
                            for="article.slug"
                            :value="__('Slug')"
                        />
                        <div class="mt-1 relative flex items-center">
                            <x-input
                                wire:model.defer="article.slug"
                                type="text"
                                :placeholder="__('article-permalink')"
                            />
                            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <button
                                    wire:click="generateSlug"
                                    type="button"
                                    class="inline-flex items-center border border-slate-200 rounded px-2 text-sm font-sans font-medium text-slate-400 hover:bg-blue-500 hover:border-blue-500 hover:text-white dark:border-slate-500 dark:hover:border-blue-500"
                                    data-tippy-content="{{ __('Generate slug') }}"
                                >
                                    <x-heroicon-o-arrow-path class="w-3 h-3" />
                                </button>
                            </div>
                        </div>
                        <x-input-error
                            for="article.slug"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="article.excerpt"
                            :value="__('Excerpt')"
                        />
                        <x-textarea
                            wire:model.defer="article.excerpt"
                            class="mt-1"
                            :placeholder="__('Write something to describe your article')"
                        />
                        <x-input-error
                            for="article.excerpt"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="article.collection_id"
                            :value="__('Collection')"
                        />
                        <x-select
                            wire:model.defer="article.collection_id"
                            class="mt-1"
                        >
                            <option value="">{{ __('None') }}</option>
                            @foreach ($this->collections as $collection)
                                <option value="{{ $collection->id }}">
                                    {{ $collection->name }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error
                            for="article.collection_id"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="article.seo_title"
                            :value="__('SEO title')"
                        />
                        <x-input
                            wire:model.defer="article.seo_title"
                            type="text"
                            class="mt-1"
                            :placeholder="__('SEO title')"
                        />
                        <x-input-error
                            for="article.seo_title"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="article.seo_description"
                            :value="__('SEO description')"
                        />
                        <x-textarea
                            wire:model.defer="article.seo_description"
                            class="mt-1"
                            :placeholder="__('SEO description')"
                        />
                        <x-input-error
                            for="article.seo_description"
                            class="mt-2"
                        />
                    </div>
                </div>
                <div
                    x-data="{ confirmingArticleDeletion: false }"
                    class="mt-6 pt-6"
                >
                    <div
                        x-cloak
                        x-show="confirmingArticleDeletion"
                        class="flex items-center justify-between space-x-2"
                    >
                        <x-button.secondary
                            x-on:click="confirmingArticleDeletion = false"
                            class="w-full"
                        >
                            {{ __('Cancel') }}
                        </x-button.secondary>
                        <x-button.danger
                            wire:click="delete"
                            class="w-full"
                        >
                            {{ __('Delete') }}
                        </x-button.danger>
                    </div>
                    <div x-show="!confirmingArticleDeletion">
                        <x-button.soft-danger
                            x-on:click="confirmingArticleDeletion = true"
                            class="w-full"
                        >
                            {{ __('Delete article') }}
                        </x-button.soft-danger>
                    </div>
                </div>
            </div>
        </x-slot:content>
        <x-slot:footer>
            <x-button.text
                wire:click="$set('showSettings', false)"
                type="button"
            >
                {{ __('Cancel') }}
            </x-button.text>
            <x-button.primary
                wire:click="save"
                type="button"
                class="ml-4"
            >
                {{ __('Save') }}
            </x-button.primary>
        </x-slot:footer>
    </x-slide-over-panel>

    <div
        x-data="{ addFromURL: false, selectedMedia: null }"
        x-on:open-media-modal.window="@this.showMediaModal = true"
    >
        <x-dialog-modal wire:model="showMediaModal">
            <x-slot:title>
                {{ __('Media') }}
            </x-slot:title>
            <x-slot:content>
                @if ($errors->has('mediaFile'))
                    <div class="mb-8 rounded-md bg-red-50 p-4">
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

                @unless($this->media->count())
                    {{--Upload form--}}
                    <div
                        x-on:click="$refs.mediaInput.click()"
                        class="flex justify-center rounded-md border-2 border-dashed border-slate-300 px-6 pt-5 pb-6 cursor-pointer hover:border-slate-400 dark:border-slate-500 dark:hover:border-slate-400"
                    >
                        <div class="space-y-1 text-center">
                            <svg
                                wire:target="mediaFile"
                                wire:loading.remove
                                class="mx-auto h-12 w-12 text-slate-400"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 48 48"
                                aria-hidden="true"
                            >
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </svg>
                            <x-loading-spinner
                                wire:target="mediaFile"
                                wire:loading.flex
                                class="mx-auto h-10 w-10 text-slate-400"
                            />
                            <div class="flex justify-center text-sm text-slate-600">
                                <label
                                    for="media-upload"
                                    class="relative cursor-pointer rounded-md bg-white font-medium text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:text-blue-500"
                                >
                                    <span>{{ __('Upload a file') }}</span>
                                    <input
                                        x-ref="mediaInput"
                                        wire:model.defer="mediaFile"
                                        id="media-upload"
                                        name="media-upload"
                                        type="file"
                                        class="sr-only"
                                    >
                                </label>
                            </div>
                            <p class="text-xs text-slate-500">
                                {{ __('Maximum file size allowed: :size megabytes', ['size' => $this->maxUploadSize / 1000]) }}
                            </p>
                        </div>
                    </div>
                @else
                    {{--Media list--}}
                    <ul class="mt-8 grid grid-cols-2 auto-rows-fr gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                        @foreach ($this->media as $media)
                            <li class="relative">
                                <div
                                    class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-slate-100 overflow-hidden"
                                    :class="{ 'ring-2 ring-offset-2 ring-blue-500 dark:ring-offset-slate-800': selectedMedia === {{ $media->id }} }"
                                >
                                    @if(str_contains($media->mime_type, 'image'))
                                        <img
                                            src="{{ $media->getUrl() }}"
                                            alt="{{ $media->name }}"
                                            class="object-cover pointer-events-none"
                                            :class="{ 'group-hover:opacity-75': selectedMedia !== {{ $media->id }} }"
                                        >
                                    @endif
                                    @if(str_contains($media->mime_type, 'video'))
                                        <video
                                            src="{{ $media->getUrl() }}"
                                            alt="{{ $media->name }}"
                                            class="object-cover pointer-events-none"
                                            :class="{ 'group-hover:opacity-75': selectedMedia !== {{ $media->id }} }"
                                        >
                                            {{ __('Your browser does not support the video tag.') }}
                                        </video>
                                    @endif
                                    <button
                                        x-on:click="selectedMedia = {{ $media->id }}"
                                        class="absolute inset-0 focus:outline-none"
                                    >
                                    <span class="sr-only">
                                        {{ __('Select this media') }}
                                    </span>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                        <li
                            wire:loading.delay
                            class="relative"
                        >
                            <div class="block w-full aspect-w-10 aspect-h-7 rounded-lg bg-slate-100 overflow-hidden">
                                <x-loading-spinner class="absolute inset-0 m-auto w-5 h-5" />
                            </div>
                        </li>
                        <li class="relative">
                            <div
                                x-on:click="$refs.mediaInput.click()"
                                class="flex justify-center items-center h-full w-full rounded-md border-2 border-dashed border-slate-300 cursor-pointer hover:border-slate-400 dark:border-slate-500 dark:hover:border-slate-400"
                            >
                                <div class="space-y-1 text-center">
                                    <svg
                                        class="mx-auto h-12 w-12 text-slate-400"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 48 48"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                    </svg>
                                    <div class="flex text-sm text-slate-600">
                                        <label
                                            for="media-upload"
                                            class="relative cursor-pointer rounded-md bg-white font-medium text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:text-blue-500"
                                        >
                                            <span class="sr-only">{{ __('Upload a file') }}</span>
                                            <input
                                                x-ref="mediaInput"
                                                wire:model.defer="mediaFile"
                                                id="media-upload"
                                                name="media-upload"
                                                type="file"
                                                class="sr-only"
                                            >
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endunless
            </x-slot:content>
            <x-slot:footer>
                <div>
                    <x-button.secondary
                        x-on:click="$wire.set('showMediaModal', false)"
                        type="button"
                    >
                        {{ __('Cancel') }}
                    </x-button.secondary>
                    <x-button.soft-danger
                        x-show="selectedMedia"
                        x-on:click.prevent="if(confirm('{{ __('Are you sure you want to delete this media?') }}')) $wire.deleteMedia(selectedMedia); selectedMedia = null;"
                        type="button"
                        class="ml-3"
                    >
                        {{ __('Delete') }}
                    </x-button.soft-danger>
                    <x-button.primary
                        x-show="selectedMedia"
                        x-on:click="$wire.insertMedia(selectedMedia); selectedMedia = null"
                        type="button"
                        class="ml-3"
                    >
                        {{ __('Insert') }}
                    </x-button.primary>
                </div>
            </x-slot:footer>
        </x-dialog-modal>
    </div>
</div>
