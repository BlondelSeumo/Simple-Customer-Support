@props(['expanded' => false])

<div x-data="{ expanded: @json($expanded) }">
    <div class="border-b border-slate-200 pb-6 space-y-1 dark:border-slate-600">
        <div>
            <h2>
                <button
                    x-on:click="expanded = !expanded"
                    type="button"
                    class="relative flex w-full items-center justify-between text-left hover:text-blue-500 dark:text-slate-300 dark:hover:text-slate-200"
                >
                    <span
                        class="font-display leading-6 text-lg text-slate-900 dark:text-slate-200"
                        :class="{ 'text-blue-600': expanded, 'text-slate-900': !(expanded) }"
                    >
                        {{ $title }}
                    </span>
                    <span class="ml-6 flex items-center">
                        <x-heroicon-m-minus
                            x-cloak
                            x-show="expanded"
                            class="h-5 w-5"
                        />
                        <x-heroicon-m-plus
                            x-show="!expanded"
                            class="h-5 w-5"
                        />
                    </span>
                </button>
            </h2>
        </div>
        <p class="mt-1 max-w-2xl text-sm text-slate-500 dark:text-slate-400">
            {{ $description }}
        </p>
    </div>

    <div
        x-cloak
        x-collapse
        x-show="expanded"
    >
        {{ $content }}
    </div>
</div>
