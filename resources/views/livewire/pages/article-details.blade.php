<div>
    <x-slot:title>
        {{ $article->seo_title ?? $article->title }}
    </x-slot:title>

    <x-slot:description>
        {{ $article->seo_description ?? $article->excerpt }}
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

            @if($article->collection)
                <li>
                    <div class="flex items-center">
                        <x-heroicon-m-chevron-right class="h-5 w-5 flex-shrink-0 text-slate-400" />
                        <a
                            href="{{ route('guest.collection-details', $article->collection) }}"
                            class="ml-4 text-sm font-medium text-slate-500 hover:text-slate-700"
                        >
                            {{ $article->collection->name }}
                        </a>
                    </div>
                </li>
            @endif

            <li>
                <div class="flex items-center">
                    <x-heroicon-m-chevron-right class="h-5 w-5 flex-shrink-0 text-slate-400" />
                    <a
                        href="{{ route('guest.article-details', $article) }}"
                        class="ml-4 text-sm font-medium text-slate-500 hover:text-slate-700"
                    >
                        {{ $article->title }}
                    </a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="relative max-w-3xl mx-auto px-4 space-y-4 sm:px-6 lg:px-8 lg:max-w-5xl">
        <!-- Article content -->
        <x-card class="relative overflow-hidden rounded-lg ring-slate-200">
            <x-slot name="content">
                <div class="py-4 max-w-3xl mx-auto lg:py-6">
                    <h1 class="font-display text-3xl">
                        {{ $article->title }}
                    </h1>
                    <div class="mt-6 text-lg text-slate-500">
                        {{ $article->excerpt }}
                    </div>
                    <div class="mt-4 flex items-center">
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
                                <time datetime="{{ $article->updated_at->toIso8601ZuluString() }}">
                                    {{ $article->updated_at->diffForHumans() }}
                                </time>
                            </p>
                        </div>
                    </div>
                    <div class="mt-8 prose prose-slate max-w-none break-words sm:prose-sm md:prose-base prose-a:text-blue-600 hover:prose-a:text-blue-500">
                        {!! $article->content !!}
                    </div>
                </div>
            </x-slot>
        </x-card>
    </div>
</div>
