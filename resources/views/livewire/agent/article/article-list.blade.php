<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Articles') }}
        </h1>
        <div class="mt-4 sm:mt-0">
            <x-button.primary
                wire:click="createArticle"
                type="button"
            >
                <x-heroicon-m-plus class="-ml-1 mr-2 w-4 h-4" />
                {{ __('New article') }}
            </x-button.primary>
        </div>
    </div>

    <div class="mt-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-card class="-mx-4 sm:-mx-0">
            <x-slot:header>
                <div>
                    <x-input
                        wire:model.debounce.500ms="search"
                        type="search"
                        placeholder="{{ __('Search for article title...') }}"
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
                                        <p class="text-sm dark:text-slate-200">{{ 'Loading articles...' }}</p>
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
                                            {{ __('Collection') }}
                                        </th>
                                        <th
                                            scope="col"
                                            class="pl-3 pr-4 py-3 text-right text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-200"
                                        >
                                            {{ __('Created on') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-600">
                                    @forelse($this->articles as $article)
                                        <tr
                                            wire:loading.class.delay="opacity-50"
                                            class="relative hover:bg-slate-50 dark:hover:bg-slate-700/25"
                                        >
                                            <td class="whitespace-nowrap pl-4 py-4 sm:pl-6 font-medium text-sm text-slate-900 dark:text-slate-200">
                                                <a
                                                    href="{{ route('agent.articles.details', $article) }}"
                                                    class="hover:text-blue-500 hover:underline dark:hover:text-blue-400"
                                                >
                                                    {{ $article->title }}
                                                </a>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-left text-sm text-slate-500 dark:text-slate-400">
                                                {{ $article->collection->name ?? __('No collection') }}
                                            </td>
                                            <td class="whitespace-nowrap pr-4 pl-3 py-4 text-right text-sm text-slate-500 sm:pr-6 dark:text-slate-400">
                                                {{ $article->created_at->toFormattedDateString() }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr wire:loading.class.delay="opacity-50">
                                            <td
                                                colspan="3"
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
            @if($this->articles->hasPages())
                <x-slot:footer>
                    {{ $this->articles->links() }}
                </x-slot:footer>
            @endif
        </x-card>
    </div>
</div>
