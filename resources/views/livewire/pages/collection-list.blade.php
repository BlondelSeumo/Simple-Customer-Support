<div>
    <x-slot:title>
        {{ __('Knowledge Base') }}
    </x-slot:title>

    <x-slot:description>
        {{ __('Browse our topically organized knowledge base.') }}
    </x-slot:description>

    <x-slot:header>
        <div class="relative -mb-36 max-w-md mx-auto px-4 pb-8 sm:max-w-3xl sm:px-6 lg:max-w-5xl lg:px-8">
            <h1 class="sr-only">
                {{ __('How can we help you?') }}
            </h1>
            <div class="relative z-30">
                <livewire:search-form inputClasses="rounded-lg" />
            </div>
        </div>
    </x-slot:header>

    <nav
        class="relative flex max-w-3xl mx-auto p-4 sm:px-6 lg:px-8 lg:max-w-5xl"
        aria-label="Breadcrumb"
    >
        <ol
            role="list"
            class="flex items-center whitespace-nowrap overflow-x-auto space-x-3"
        >
            <li>
                <div>
                    <a
                        href="/"
                        class="text-slate-400 hover:text-slate-500"
                    >
                        <x-heroicon-m-home class="h-5 w-5 flex-shrink-0 text-slate-400" />
                        <span class="sr-only">
                            {{ __('Home') }}
                        </span>
                    </a>
                </div>
            </li>

            <li>
                <div class="flex items-center">
                    <x-heroicon-m-chevron-right class="h-5 w-5 flex-shrink-0 text-slate-400" />
                    <a
                        href="{{ route('guest.collection-list') }}"
                        class="ml-4 text-sm font-medium text-slate-500 hover:text-slate-700"
                    >
                        {{ __('All collections') }}
                    </a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="relative max-w-3xl mx-auto px-4 space-y-4 sm:px-6 lg:px-8 lg:max-w-5xl">
        @forelse($this->collections as $collection)
            <x-card class="relative overflow-hidden rounded-lg ring-slate-200 hover:ring-slate-300 transition ease-in-out duration-150">
                <x-slot
                    name="content"
                    class="hover:bg-slate-50 transition ease-in-out duration-150"
                >
                    <div class="flex">
                        <div class="mr-4 sm:mr-6 lg:mr-8 flex-shrink-0 lg:self-center">
                            <img
                                src="{{ $collection->getFirstMediaUrl('icon') }}"
                                alt="{{ $collection->name }}"
                                class="h-8 w-8 mt-3 lg:mt-0 lg:h-16 lg:w-16 text-slate-300"
                            >
                        </div>
                        <div>
                            <div class="max-w-3xl">
                                <h2>
                                    <a
                                        href="{{ route('guest.collection-details', $collection->slug) }}"
                                        class="text-lg text-blue-600 hover:text-blue-500"
                                    >
                                        <span class="absolute inset-0"></span>
                                        {{ $collection->name }}
                                    </a>
                                </h2>
                                <p class="mt-1 text-base text-slate-600">
                                    {{ $collection->description }}
                                </p>
                            </div>
                            <div class="flex items-center mt-3">
                                <div class="hidden sm:flex -space-x-1 relative z-0 mr-4">
                                    @foreach($collection->authors->unique()->take(4) as $author)
                                        <img
                                            class="relative z-0 inline-block h-8 w-8 rounded-full ring-2 ring-white"
                                            src="{{ $author->getFirstMediaUrl('avatar') }}"
                                            alt="{{ $author->name }}"
                                        >
                                    @endforeach
                                </div>
                                <div class="text-xs text-slate-500">
                                    <p>
                                        {{ trans_choice(':count article in this collection|:count articles in this collection', $collection->articles_count) }}
                                    </p>
                                    <p class="mt-1">
                                        {{ __('Written by') }}
                                        @foreach($collection->authors->unique()->take(4) as $author)
                                            <span class="text-slate-700">{{ $author->name }}{{ $loop->last ? '' : ',' }}</span>
                                        @endforeach

                                        @if($collection->authors->count() > 4)
                                            <span>{{ trans_choice('and :count other|and :count others', $collection->authors->count() - 4) }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-card>
        @empty
            <x-card class="relative overflow-hidden rounded-lg ring-slate-200 hover:ring-slate-300 transition ease-in-out duration-150">
                <x-slot:content>
                    {{ __('Whoops, there are no Articles yet as we are working on it! Please check back later.') }}
                </x-slot:content>
            </x-card>
        @endforelse
    </div>
</div>
