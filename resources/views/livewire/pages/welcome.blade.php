<div>
    <x-slot:title>
        {{ $layoutSettings->homepage_meta_title }}
    </x-slot:title>

    <x-slot:description>
        {{ $layoutSettings->homepage_meta_description }}
    </x-slot:description>

    <x-slot:header>
        <div class="relative mt-24 max-w-md mx-auto px-4 pb-40 sm:max-w-3xl sm:px-6 md:mt-32 lg:max-w-5xl lg:px-8">
            <h1 class="font-display font-medium tracking-tight text-center text-white text-4xl sm:text-6xl">
                {{ __('How can we help you?') }}
            </h1>
            <p class="mt-3 tracking-tight text-center text-white text-lg">
                {{ __('Search here to get answers to your questions') }}
            </p>
            <div class="relative mt-10 max-w-2xl mx-auto">
                <livewire:search-form
                    input-classes="rounded-full"
                    :suggested-searches="$layoutSettings->homepage_suggested_searches"
                    :show-suggested-searches="true"
                />
            </div>
        </div>
    </x-slot:header>

    <div class="bg-white">
        <!-- Actions panel -->
        <section
            aria-labelledby="quick-links-title"
            class="relative -mt-32 max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-5xl lg:px-8"
        >
            <div class="rounded-lg bg-slate-200 overflow-hidden shadow-lg shadow-blue-500/50 divide-y divide-slate-200 sm:divide-y-0 sm:grid sm:grid-cols-3 md:grid-cols-2 sm:gap-px">
                <h2
                    class="sr-only"
                    id="quick-links-title"
                >
                    {{ __('Quick links') }}
                </h2>

                <div class="relative group bg-white p-6">
                    <div>
                        <span class="rounded-lg inline-flex p-3 bg-blue-50 text-blue-700 ring-4 ring-white">
                            <x-heroicon-o-academic-cap class="h-6 w-6" />
                        </span>
                    </div>
                    <div class="mt-8">
                        <h3 class="font-display text-lg">
                            <a
                                href="{{ route('guest.collection-list') }}"
                                class="focus:outline-none"
                            >
                                <!-- Extend touch target to entire panel -->
                                <span
                                    class="absolute inset-0"
                                    aria-hidden="true"
                                ></span>
                                {{ __('Knowledge Base') }}
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-slate-500">
                            {{ __('Browse our knowledge base to find answers to your questions. You can also search for specific topics using our search form.') }}
                        </p>
                    </div>
                    <span
                        class="pointer-events-none absolute top-6 right-6 text-slate-300 group-hover:text-slate-400"
                        aria-hidden="true"
                    >
                        <x-heroicon-m-arrow-up-right class="h-6 w-6" />
                    </span>
                </div>

                <div class="relative group bg-white p-6">
                    <div>
                        <span class="rounded-lg inline-flex p-3 bg-blue-50 text-blue-700 ring-4 ring-white">
                            <x-heroicon-o-cursor-arrow-ripple class="h-6 w-6" />
                        </span>
                    </div>
                    <div class="mt-8">
                        <h3 class="font-display text-lg">
                            <a
                                href="{{ route('user.tickets.create') }}"
                                class="focus:outline-none"
                            >
                                <!-- Extend touch target to entire panel -->
                                <span
                                    class="absolute inset-0"
                                    aria-hidden="true"
                                ></span>
                                {{ __('Get in touch') }}
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-slate-500">
                            {{ __('If you can\'t find what you\'re looking for, you can contact us. We\'re always here to help.') }}
                        </p>
                    </div>
                    <span
                        class="pointer-events-none absolute top-6 right-6 text-slate-300 group-hover:text-slate-400"
                        aria-hidden="true"
                    >
                        <x-heroicon-m-arrow-up-right class="h-6 w-6" />
                    </span>
                </div>
            </div>
        </section>

        <!-- Popular articles section -->
        <section
            aria-labelledby="popular-articles-title"
            class="relative mx-auto max-w-5xl px-4 pt-20 pb-14 sm:px-6 lg:px-8 sm:pb-20 sm:pt-32 lg:pb-32"
        >
            <div class="max-w-3xl lg:mx-auto lg:text-center">
                <h2
                    id="popular-articles-title"
                    class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl"
                >
                    {{ __('Browse our Topics') }}
                </h2>
                <p class="mt-4 text-lg tracking-tight text-slate-700">
                    {{ __('Browse our knowledge base to find answers to your questions.') }}
                </p>
            </div>
            <div class="mt-20">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    @foreach($this->collections->take(4) as $collection)
                        <x-card class="relative rounded-lg !ring-slate-200 hover:ring-blue-200 hover:shadow-lg hover:shadow-blue-500/50 transition">
                            <x-slot:header>
                                <div class="flex items-center justify-between">
                                    <h3 class="font-display text-lg truncate">
                                        {{ $collection->name }}
                                    </h3>
                                    <a
                                        href="{{ route('guest.collection-details', $collection) }}"
                                        class="ml-3 flex-shrink-0 text-sm text-blue-600 hover:text-blue-500"
                                    >
                                        {{ __('View all') }}
                                    </a>
                                </div>
                            </x-slot:header>
                            <x-slot:content>
                                <ul
                                    role="list"
                                    class="-my-4 divide-y divide-slate-200"
                                >
                                    @foreach($collection->articles->take(5) as $article)
                                        <li class="py-4">
                                            <a
                                                href="{{ route('guest.article-details', $article) }}"
                                                class="group inline-flex items-start text-sm text-slate-700 hover:text-blue-500"
                                            >
                                                <x-heroicon-o-newspaper class="mr-2 mt-0.5 flex-shrink-0 h-4 w-4 text-slate-700 group-hover:text-blue-500" />
                                                {{ $article->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="absolute flex w-full bottom-0 -mb-px inset-x-0 h-[2px] bg-gradient-to-r from-blue-400/0 via-blue-400/50 to-blue-400/0"></div>
                            </x-slot:content>
                        </x-card>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Get in touch -->
        <section
            id="get-in-touch"
            class="relative overflow-hidden bg-blue-600 py-32"
        >
            <img
                src="{{ asset('img/background-call-to-action.jpg') }}"
                alt=""
                width="2347"
                height="1244"
                decoding="async"
                class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2"
                loading="lazy"
            >
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 relative">
                <div class="mx-auto max-w-xl text-center">
                    <h2 class="font-display text-3xl tracking-tight text-white sm:text-4xl">
                        {{ __('Get in touch with us') }}
                    </h2>
                    <p class="mt-4 text-lg tracking-tight text-white">
                        {{ __('Can\'t find what you are looking for? No worries, Our staff is always here to help you solve the problems you are facing.') }}
                    </p>
                    <a
                        href="{{ route('user.tickets.create') }}"
                        class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-slate-900 hover:bg-blue-50 active:bg-blue-200 active:text-slate-600 focus-visible:outline-white mt-10"
                    >
                        {{ __('Submit a ticket') }}
                        <svg
                            class="mt-0.5 ml-2 -mr-1 stroke-slate-900 stroke-2"
                            fill="none"
                            width="10"
                            height="10"
                            viewBox="0 0 10 10"
                            aria-hidden="true"
                        >
                            <path
                                class="opacity-0 transition group-hover:opacity-100"
                                d="M0 5h7"
                            ></path>
                            <path
                                class="transition group-hover:translate-x-[3px]"
                                d="M1 1l4 4-4 4"
                            ></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Frequently asked questions -->
        <section
            id="faq"
            aria-labelledby="faq-title"
            class="relative overflow-hidden bg-slate-50 py-20 sm:py-32"
        >
            <img
                alt=""
                src="{{ asset('img/background-faqs.jpg') }}"
                width="1558"
                height="946"
                decoding="async"
                data-nimg="future"
                class="absolute top-0 left-1/2 max-w-none translate-x-[-30%] -translate-y-1/4"
                loading="lazy"
            >
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 relative">
                <div class="mx-auto max-w-3xl lg:mx-0">
                    <h2
                        id="faq-title"
                        class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl"
                    >
                        {{ $layoutSettings->homepage_faq_title ?? __('Frequently asked questions') }}
                    </h2>
                    <p class="mt-4 text-lg tracking-tight text-slate-700">
                        {{ $layoutSettings->homepage_faq_description }}
                    </p>
                </div>
                <ul
                    role="list"
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:max-w-none lg:grid-cols-2"
                >
                    @foreach($layoutSettings->homepage_faq_items as $item)
                        <li>
                            <h3 class="font-display text-lg leading-7 text-slate-900">{!! $item['question'] !!}</h3>
                            <p class="mt-4 text-sm text-slate-700">{!! $item['answer'] !!}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</div>
