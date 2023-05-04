<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full"
    x-cloak
    x-data="{ theme: $persist('light') }"
    x-bind:class="{ 'dark': theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
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
        @livewireStyles
        @vite('resources/css/app.css')
    </head>
    <body class="h-full antialiased font-sans dark:bg-slate-800">
        <div
            id="main"
            x-data="{ open: false }"
            @keydown.window.escape="open = false"
            class="min-h-full flex"
        >
            <livewire:agent.sidebar-navigation />

            <div class="lg:pl-64 flex flex-col w-0 flex-1">
                <div class="bg-white sticky top-0 z-20 flex-shrink-0 flex h-16 border-b border-slate-200 dark:border-slate-600 dark:bg-slate-800">
                    <button
                        @click="open = !open"
                        type="button"
                        class="px-4 border-r border-slate-200 text-slate-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-slate-900 lg:hidden dark:border-slate-600"
                    >
                        <span class="sr-only">{{ __('Open sidebar') }}</span>
                        <x-heroicon-o-bars-3-bottom-left class="h-6 w-6" />
                    </button>
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex">
                            <form
                                class="w-full flex md:ml-0"
                                action="#"
                                method="GET"
                            >
                                <label
                                    for="search-field"
                                    class="sr-only"
                                >
                                    {{ __('Search') }}
                                </label>
                                <div class="relative w-full text-slate-400 focus-within:text-slate-600 dark:focus-within:text-slate-300">
                                    <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                        <x-heroicon-s-magnifying-glass class="w-5 h-5" />
                                    </div>
                                    <input
                                        id="search-field"
                                        type="search"
                                        name="search"
                                        class="block w-full h-full pl-8 pr-3 py-2 border-transparent bg-transparent text-slate-900 placeholder-slate-500 focus:outline-none focus:placeholder-slate-400 focus:ring-0 focus:border-transparent sm:text-sm dark:text-slate-100 dark:placeholder-slate-400 dark:focus:placeholder-slate-500"
                                        placeholder="{{ __('Search') }}"
                                    >
                                </div>
                            </form>
                        </div>
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Notification -->
                            <livewire:agent.notification-bell />

                            <!-- Open ticket dropdown -->
                            <livewire:agent.open-ticket-dropdown />

                            <!-- Theme switcher -->
                            <div class="ml-3 relative">
                                <x-dropdown>
                                    <x-slot:trigger>
                                        <button
                                            type="button"
                                            class="p-1 text-slate-400 rounded-full hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-slate-300 dark:hover:text-slate-200 dark:focus:ring-offset-slate-800"
                                        >
                                            <template x-if="theme === 'light'">
                                                <x-heroicon-o-sun class="w-6 h-6" />
                                            </template>
                                            <template x-if="theme === 'dark'">
                                                <x-heroicon-o-moon class="w-6 h-6" />
                                            </template>
                                            <template x-if="theme === 'system'">
                                                <x-heroicon-o-computer-desktop class="w-6 h-6" />
                                            </template>
                                        </button>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        <x-dropdown-link
                                            x-on:click="theme = 'light'"
                                            role="button"
                                            class="flex items-center space-x-2"
                                        >
                                            <x-heroicon-m-sun class="w-5 h-5" />
                                            <span>{{ __('Light') }}</span>
                                        </x-dropdown-link>
                                        <x-dropdown-link
                                            x-on:click="theme = 'dark'"
                                            role="button"
                                            class="flex items-center space-x-2"
                                        >
                                            <x-heroicon-m-moon class="w-5 h-5" />
                                            <span>{{ __('Dark') }}</span>
                                        </x-dropdown-link>
                                        <x-dropdown-link
                                            x-on:click="theme = 'system'"
                                            role="button"
                                            class="flex items-center space-x-2"
                                        >
                                            <x-heroicon-m-computer-desktop class="w-5 h-5" />
                                            <span>{{ __('System') }}</span>
                                        </x-dropdown-link>
                                    </x-slot:content>
                                </x-dropdown>
                            </div>

                            <!-- Profile dropdown -->
                            <div class="ml-3 relative">
                                <x-dropdown>
                                    <x-slot:trigger>
                                        <button
                                            type="button"
                                            class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-slate-800"
                                            aria-expanded="false"
                                            aria-haspopup="true"
                                        >
                                            <span class="sr-only">{{ __('Open user menu') }}</span>
                                            <img
                                                src="{{ auth()->user()->getFirstMediaUrl('avatar') }}"
                                                alt="{{ __('Avatar') }}"
                                                class="w-8 h-8 rounded-full"
                                            >
                                        </button>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        <x-dropdown-link href="{{ route('agent.profile') }}">
                                            {{ __('Account Profile') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('agent.canned-responses') }}">
                                            {{ __('Canned Response') }}
                                        </x-dropdown-link>
                                        <div class="relative block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 transition duration-150 ease-in-out cursor-pointer dark:text-slate-300 dark:hover:bg-slate-600">
                                            <livewire:agent.auth.logout />
                                        </div>
                                    </x-slot:content>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="flex-1">
                    <div class="py-6">
                        {{ $slot }}
                    </div>
                </main>

                <x-notification />
            </div>
        </div>

        <!-- Scripts -->
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
