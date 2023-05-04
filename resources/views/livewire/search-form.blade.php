<div>
    <div
        x-data="{ open: false }"
        x-trap.noscroll.noreturn="open"
    >
        <div
            x-cloak
            x-show="open"
            x-on:click="open = false"
            x-on:keydown.escape.window="open = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-500/50 backdrop-blur-sm transition-opacity"
            :class="{'z-30': open}"
        ></div>

        <div
            class="group relative"
            :class="{'z-40': open}"
        >
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <x-heroicon-m-magnifying-glass class="h-6 w-6 text-white group-focus-within:text-slate-400" />
            </div>
            <label
                class="sr-only"
                for="search"
            >
                {{ __('Type something to search...') }}
            </label>
            <input
                wire:model.debounce="query"
                x-ref="searchInput"
                x-on:click="open = true"
                id="search"
                type="search"
                class="block w-full text-md border-0 pr-4 pl-12 py-5 text-white shadow-sm bg-white/20 placeholder:text-white/75 focus:ring-0 focus:bg-white/100 focus:text-slate-900 focus:placeholder:text-slate-500 transition duration-150 {{ $inputClasses ?? '' }}"
                placeholder="{{ __('Search for Articles...') }}"
                autocomplete="off"
            >
        </div>

        @if(!empty($query))
            <div class="absolute w-full z-30 mt-3">
                <div
                    x-show="open"
                    class="w-full bg-white shadow rounded-md before:absolute before:bg-white before:h-3 before:w-3 before:-top-1.5 before:left-10 before:border-left before:border-top before:rotate-45"
                >
                    @if(!empty($articles))
                        <ul class="max-h-72 py-2 overflow-y-auto text-sm text-slate-800">
                            @foreach($articles as $article)
                                <li class="relative px-4 py-2 hover:bg-blue-600 hover:text-white focus-within:bg-blue-600 focus-within:text-white">
                                    <a
                                        href="{{ route('guest.article-details', $article['slug']) }}"
                                        class="focus:outline-none"
                                    >
                                        <span class="absolute inset-0"></span>
                                        {{ $article['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="p-4 text-sm text-slate-500">
                            {{ __('There were no results matching your keyword.') }}
                            <a
                                href="{{ route('user.tickets.create') }}"
                                class="text-blue-500 hover:text-blue-600"
                            >
                                {{ __('Submit a new ticket') }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        @endif

        @if($showSuggestedSearches && count($suggestedSearches))
            <div class="flex items-center justify-center mt-2 px-4 text-white">
                <span class="font-medium">{{ __('Suggested:') }}</span>
                <ul class="inline-flex ml-3 space-x-3 overflow-x-auto text-sm whitespace-nowrap">
                    @foreach($suggestedSearches as $keyword)
                        <li>
                            <button
                                x-on:click="open = true; $refs.searchInput.focus(); $wire.set('query', '{{ $keyword }}');"
                                class="hover:text-blue-100"
                            >
                                {{ $keyword }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
