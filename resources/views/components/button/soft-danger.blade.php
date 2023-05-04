@props(['disabled' => false])

<x-button :disabled="$disabled" {{ $attributes->merge(['type' => 'button', 'class' => 'bg-red-100 text-red-700 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300 dark:bg-slate-700 dark:border-slate-500 dark:text-red-400 dark:hover:border-red-600 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-offset-slate-800']) }}>
    {{ $slot }}
</x-button>
