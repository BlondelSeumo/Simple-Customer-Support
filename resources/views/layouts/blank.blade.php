<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full bg-white"
    @if(request()->routeIs('agent.*'))
        x-cloak
    x-data="{ theme: $persist('light') }"
    x-bind:class="{ 'dark': theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
    @endif
>
    <head>
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >

        <title>{{ $title ?? $generalSettings->site_name ?: config('app.name', 'Ticksify') }}</title>

        <meta
            name="description"
            content="{{ $description ?? $generalSettings->site_description }}"
        />

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
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Lexend:wght@400;500&display=swap"
        >

        <!-- Styles -->
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body class="h-full antialiased">
        <div class="flex min-h-full">
            {{ $slot }}
        </div>

        @if($generalSettings->recaptcha_enabled)
            {!! GoogleReCaptchaV3::init() !!}
        @endif

        <!-- Scripts -->
        @vite('resources/js/app.js')
        @livewireScripts
    </body>
</html>
