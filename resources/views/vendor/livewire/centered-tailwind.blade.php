<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <nav
            role="navigation"
            aria-label="Pagination Navigation"
            class="flex items-center justify-between"
        >
            <div class="flex w-0 flex-1">
                {{-- Previous Page Link --}}
                <button
                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center text-sm font-medium text-slate-500 hover:enabled:border-slate-300 hover:enabled:text-slate-700 disabled:cursor-not-allowed disabled:opacity-50 dark:text-slate-400 dark:hover:enabled:text-slate-300"
                    @disabled($paginator->onFirstPage())
                >
                    <x-heroicon-m-arrow-long-left class="mr-3 h-5 w-5 text-slate-400" />
                    {!! __('pagination.previous') !!}
                </button>
            </div>

            <div class="hidden md:-mt-px md:flex">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span class="inline-flex items-center px-4 text-sm font-medium text-slate-500">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="inline-flex items-center px-4 text-sm font-medium text-blue-600 dark:text-blue-500"
                                    aria-current="page"
                                >
                                    {{ $page }}
                                </span>
                            @else
                                <button
                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center px-4 text-sm font-medium text-slate-500 hover:border-slate-300 hover:text-slate-700 dark:text-slate-400 dark:hover:enabled:text-slate-300"
                                >
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            <div class="flex w-0 flex-1 justify-end">
                {{-- Next Page Link --}}
                <button
                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center text-sm font-medium text-slate-500 hover:enabled:border-slate-300 hover:enabled:text-slate-700 disabled:cursor-not-allowed disabled:opacity-50 dark:text-slate-400 dark:hover:enabled:text-slate-300"
                    @disabled(! $paginator->hasMorePages())
                >
                    {!! __('pagination.next') !!}
                    <x-heroicon-m-arrow-long-right class="ml-3 h-5 w-5 text-slate-400" />
                </button>
            </div>
        </nav>
    @endif
</div>
