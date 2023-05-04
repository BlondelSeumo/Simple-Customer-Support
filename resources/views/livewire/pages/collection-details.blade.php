<div>
    <x-slot:title>
        {{ $collection->name }}
    </x-slot:title>

    <x-slot:description>
        {{ $collection->description }}
    </x-slot:description>

    <x-slot:header>
        <div class="relative -mb-36 max-w-md mx-auto px-4 pb-8 sm:max-w-3xl sm:px-6 lg:max-w-5xl lg:px-8">
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

            <li>
                <div class="flex items-center">
                    <x-heroicon-m-chevron-right class="h-5 w-5 flex-shrink-0 text-slate-400" />
                    <a
                        href="{{ route('guest.collection-details', $collection) }}"
                        class="ml-4 text-sm font-medium text-slate-500 hover:text-slate-700"
                    >
                        {{ $collection->name }}
                    </a>
                </div>
            </li>
        </ol>
    </nav>

    @if($collection->articles->count())
        <div class="relative max-w-3xl mx-auto px-4 space-y-4 sm:px-6 lg:px-8 lg:max-w-5xl">
            <x-card class="relative overflow-hidden rounded-lg ring-slate-200">
                <x-slot name="content">
                    <ul class="divide-y divide-slate-200 -m-4 sm:-m-6 overflow-hidden">
                        @foreach($collection->articles as $article)
                            <li class="relative p-4 py-6 sm:px-6 lg:px-8 hover:bg-slate-50 transition ease-in-out duration-150">
                                <div class="max-w-3xl">
                                    <h2>
                                        <a
                                            href="{{ route('guest.article-details', $article->slug) }}"
                                            class="text-lg text-blue-600 hover:text-blue-500"
                                        >
                                            <span class="absolute inset-0"></span>
                                            {{ $article->title }}
                                        </a>
                                    </h2>
                                    <p class="mt-1 text-base text-slate-600">
                                        {{ $article->excerpt }}
                                    </p>
                                </div>

                                <div class="flex items-center mt-3">
                                    <div class="mr-4 flex flex-shrink-0 items-center">
                                    <span class="inline-block h-10 w-10 rounded-full overflow-hidden">
                                        <img
                                            src="{{ $article->author->getFirstMediaUrl('avatar') }}"
                                            alt="{{ $article->author->name }}"
                                            class="h-full w-full"
                                        >
                                    </span>
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        <p>
                                            {{ __('Written by') }}
                                            <span class="text-slate-700">{{ $article->author->name }}</span>
                                        </p>
                                        <p class="mt-1">
                                            {{ __('Last updated') }}
                                            <time datetime="{{ $article->updated_at->toIso8601ZuluString() }}">{{ $article->updated_at->diffForHumans() }}</time>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </x-slot>
            </x-card>
        </div>
    @endif
</div>
