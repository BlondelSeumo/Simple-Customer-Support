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

        <title>{{ $title ?? $generalSettings->site_name }}</title>

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
        @livewireStyles
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-50 font-sans text-slate-900 antialiased">
        @if($generalSettings->announcement_enabled)
            <x-announcement-banner />
        @endif

        <header
            x-data="{ open: false }"
            class="relative bg-blue-600 pb-36"
        >
            <!-- Header background -->
            <div class="absolute inset-0">
                <img
                    src="{{ asset('img/background-header.jpg') }}"
                    alt="Header background"
                    class="w-full h-full object-cover"
                    fetchpriority="high"
                >
            </div>

            <!-- Header navigation -->
            <div
                class="relative"
                :class="{'z-50': open, 'z-20': !open}"
            >
                <!-- Desktop navigation -->
                <nav
                    class="relative max-w-5xl mx-auto flex items-center justify-between px-4 py-6 sm:px-6 lg:px-8"
                    aria-label="Global"
                >
                    <div class="flex items-center flex-1">
                        <div class="flex items-center justify-between w-full lg:w-auto">
                            <a href="/">
                                <img
                                    src="{{ $generalSettings->logo_path ? Storage::url($generalSettings->logo_path) : asset('img/logo-white-full.png') }}"
                                    alt="{{ $generalSettings->site_name ?: config('app.name', 'Ticksify') }}"
                                    class="h-8 w-auto sm:h-10"
                                >
                                <span class="sr-only">{{ config('app.name') }}</span>
                            </a>
                            <div class="-mr-2 flex items-center lg:hidden">
                                <button
                                    @click="open = !open"
                                    type="button"
                                    class="bg-blue-slate-900 bg-opacity-0 rounded-md p-2 inline-flex items-center justify-center text-white hover:bg-opacity-100 focus:outline-none focus:ring-2 focus-ring-inset focus:ring-white"
                                    aria-expanded="false"
                                    :aria-expanded="open.toString()"
                                >
                                    <span class="sr-only">{{ __('Open main menu') }}</span>
                                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="hidden lg:flex lg:items-center lg:space-x-6">
                        @guest
                            <a
                                href="{{ route('login') }}"
                                class="text-base text-white hover:text-blue-100"
                            >
                                {{ __('Sign in') }}
                            </a>
                        @else
                            @if(auth()->user()->isBanned())
                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >
                                    @csrf
                                    <a
                                        href="{{ route('login') }}"
                                        class="text-base text-white hover:text-blue-100"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                    >
                                        {{ __('Sign out') }}
                                    </a>
                                </form>
                            @else
                                <x-dropdown>
                                    <x-slot:trigger>
                                        <button
                                            type="button"
                                            class="inline-flex items-center text-base text-white hover:text-blue-100"
                                        >
                                            <span>{{ __('My account') }}</span>
                                            <x-heroicon-o-chevron-down class="ml-2 h-4 w-4" />
                                        </button>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        <x-dropdown-link :href="route('user.profile')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('user.tickets.list')">
                                            {{ __('My tickets') }}
                                        </x-dropdown-link>
                                        <hr>
                                        <form
                                            method="POST"
                                            action="{{ route('logout') }}"
                                        >
                                            @csrf
                                            <x-dropdown-link
                                                :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                            >
                                                {{ __('Sign out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot:content>
                                </x-dropdown>
                            @endif
                        @endguest
                        <span class="inline-flex rounded-md shadow">
                            <a
                                href="{{ route('user.tickets.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-slate-50"
                            >
                                {{ __('Submit a ticket') }}
                            </a>
                        </span>
                    </div>
                </nav>
                <!-- Mobile navigation -->
                <div
                    x-show="open"
                    x-trap.noreturn="open"
                    x-transition:enter="duration-150 ease-out"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="duration-100 ease-in"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    @click.away="open = false"
                    class="absolute top-0 inset-x-0 p-2 transition transform origin-top lg:hidden"
                >
                    <div class="rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="px-5 pt-4 flex items-center justify-between">
                            <div>
                                <x-application-logo class="h-8 w-auto fill-blue-600" />
                            </div>
                            <div class="-mr-2">
                                <button
                                    @click="open = false"
                                    type="button"
                                    class="bg-white rounded-md p-2 inline-flex items-center justify-center text-blue-slate-400 hover:bg-blue-slate-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                                >
                                    <span class="sr-only">{{ __('Close menu') }}</span>
                                    <x-heroicon-o-x-mark class="h-6 w-6" />
                                </button>
                            </div>
                        </div>
                        <div class="pt-5 pb-6">
                            <div class="px-2 space-y-1">
                                <a
                                    href="/"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-blue-slate-900 hover:bg-blue-slate-50"
                                >
                                    {{ __('Home') }}
                                </a>
                                <a
                                    href="{{ route('guest.collection-list') }}"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-blue-slate-900 hover:bg-blue-slate-50"
                                >
                                    {{ __('Knowledge Base') }}
                                </a>
                                <a
                                    href="{{ route('user.tickets.list') }}"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-blue-slate-900 hover:bg-blue-slate-50"
                                >
                                    {{ __('My Tickets') }}
                                </a>
                                @guest
                                    <a
                                        href="{{ route('login') }}"
                                        class="block px-3 py-2 rounded-md text-base font-medium text-blue-slate-900 hover:bg-blue-slate-50"
                                    >
                                        {{ __('Sign in') }}
                                    </a>
                                @else
                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}"
                                    >
                                        @csrf
                                        <a
                                            href="{{ route('login') }}"
                                            class="block px-3 py-2 rounded-md text-base font-medium text-blue-slate-900 hover:bg-blue-slate-50"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                        >
                                            {{ __('Sign out') }}
                                        </a>
                                    </form>
                                @endguest
                            </div>
                            <div class="mt-6 px-5">
                                <a
                                    href="{{ route('user.tickets.create') }}"
                                    class="block text-center w-full py-2 px-4 border border-transparent rounded-md shadow bg-blue-500 text-white font-medium hover:bg-blue-600"
                                >
                                    {{ __('Submit a ticket') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{ $header }}
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer>
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <p class="mt-8 text-center text-sm text-slate-500">
                    {!! __('&copy; :year :company. All rights reserved.', ['year' => now()->year, 'company' => $generalSettings->site_name ?: config('app.name', 'Ticksify')]) !!}
                </p>
            </div>
        </footer>

        @if($generalSettings->cookie_consent_enabled)
            <x-cookie-consent />
        @endif

        @if($generalSettings->setup_finished && !$generalSettings->purchase_code)
            <livewire:faded />
        @endif

        <!-- Scripts -->
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
