<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full"
>
    <head>
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >
        <meta
            name="csrf-token"
            content="{{ csrf_token() }}"
        >
        <meta
            name="robots"
            content="noindex, nofollow"
        >

        <title>@yield('title') - {{ $generalSettings->site_name ?: config('app.name') }}</title>

        <!-- Favicon -->
        <link
            rel="icon"
            href="{{ $generalSettings->favicon_path ? Storage::url($generalSettings->favicon_path) : asset('img/favicon.png') }}"
        >

        <!-- Fonts -->
        <link
            rel="preconnect"
            href="https://fonts.googleapis.com"
        >
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin
        >
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        >

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased font-sans h-full">
        <div class="min-h-full pt-16 pb-12 flex flex-col bg-white">
            <main class="flex-grow flex flex-col justify-center max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex-shrink-0 flex justify-center">
                    <a
                        href="/"
                        class="inline-flex"
                    >
                        <span class="sr-only">{{ $generalSettings->favicon_path ?: config('app.name') }}</span>
                        <img
                            class="h-12 w-auto"
                            src="{{ $generalSettings->favicon_path ? Storage::url($generalSettings->favicon_path) : asset('img/favicon.png') }}"
                            alt="{{ $generalSettings->site_name ?: config('app.name') }}"
                        >
                    </a>
                </div>
                <div class="mt-1 py-16">
                    <div class="text-center">
                        <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">@yield('code') error</p>
                        <h1 class="mt-2 text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl">@yield('title').</h1>
                        <p class="mt-2 text-base text-slate-500">@yield('message').</p>
                        <div class="mt-6">
                            <a
                                href="/"
                                class="text-base font-medium text-blue-600 hover:text-blue-500"
                            >
                                {{ __('Go back home') }}<span aria-hidden="true"> &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
