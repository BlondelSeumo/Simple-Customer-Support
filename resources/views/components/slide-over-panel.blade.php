@props(['id', 'maxWidth'])

@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? 'md'];
@endphp

<div
    x-cloak
    x-data="{ show: @entangle($attributes->wire('model')).defer }"
    x-on:keydown.window.escape="open = false"
    class="relative z-20"
>
    <div
        x-show="show"
        x-transition:enter="ease-in-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-800/75 backdrop-blur-sm"
    ></div>

    <div
        x-show="show"
        class="fixed inset-0 overflow-hidden"
    >
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <div
                    x-show="show"
                    x-transition:enter="transition ease-in-out duration-500 sm:duration-300"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-500 sm:duration-300"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    x-on:click.away="show = false"
                    class="pointer-events-auto w-screen {{ $maxWidth }}"
                >
                    <div class="flex h-full flex-col divide-y divide-slate-200 bg-white shadow-xl dark:bg-slate-700 dark:divide-slate-600">
                        <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-4">
                            <div class="px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-slate-900 dark:text-slate-200">
                                        {{ $title }}
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button
                                            x-on:click="show = false"
                                            type="button"
                                            class="rounded-md text-slate-400 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:hover:text-slate-300"
                                        >
                                            <span class="sr-only">{{ __('Close panel') }}</span>
                                            <x-heroicon-m-x-mark class="h-5 w-5" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                {{ $content }}
                            </div>
                        </div>
                        @isset($footer)
                            <div class="flex flex-shrink-0 justify-end px-4 py-4">
                                {{ $footer }}
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
