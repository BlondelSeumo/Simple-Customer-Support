<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <nav
            role="navigation"
            aria-label="Pagination Navigation"
            class="flex items-center justify-between"
        >
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-slate-300 cursor-default leading-5 rounded-md select-none dark:border-slate-600 dark:bg-slate-800">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button
                            wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700 transition ease-in-out duration-150 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-500 dark:hover:text-slate-200"
                        >
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700 transition ease-in-out duration-150 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-500 dark:hover:text-slate-200"
                        >
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-500 bg-white border border-slate-300 cursor-default leading-5 rounded-md select-none dark:border-slate-600 dark:bg-slate-800">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-slate-700 leading-5 dark:text-slate-400">
                        <span>{!! __('Showing') !!}</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('of') !!}</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        <span>{!! __('results') !!}</span>
                    </p>
                </div>

                <div>
                    <span>
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-slate-300 cursor-not-allowed leading-5 rounded-md select-none opacity-50 dark:border-slate-600 dark:bg-slate-800">
                                {!! __('pagination.previous') !!}
                            </span>
                        @else
                            @if(method_exists($paginator,'getCursorName'))
                                <button
                                    dusk="previousPage"
                                    wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                                    wire:loading.attr="disabled"
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700 transition ease-in-out duration-150 dark:border-slate-600 dark:bg-slate-800"
                                >
                                    {!! __('pagination.previous') !!}
                                </button>
                            @else
                                <button
                                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    wire:loading.attr="disabled"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700 transition ease-in-out duration-150 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-500 dark:hover:text-slate-200"
                                >
                                    {!! __('pagination.previous') !!}
                                </button>
                            @endif
                        @endif
                    </span>

                    <span>
                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            @if(method_exists($paginator,'getCursorName'))
                                <button
                                    dusk="nextPage"
                                    wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                                    wire:loading.attr="disabled"
                                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700 transition ease-in-out duration-150"
                                >
                                    {!! __('pagination.next') !!}
                                </button>
                            @else
                                <button
                                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    wire:loading.attr="disabled"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700 transition ease-in-out duration-150 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-500 dark:hover:text-slate-200"
                                >
                                    {!! __('pagination.next') !!}
                                </button>
                            @endif
                        @else
                            <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-500 bg-slate-50 border border-slate-300 cursor-not-allowed leading-5 rounded-md select-none opacity-50 dark:border-slate-600 dark:bg-slate-800">
                                {!! __('pagination.next') !!}
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
