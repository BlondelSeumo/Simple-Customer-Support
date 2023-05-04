@props(['disabled' => false, 'size'])

@php
    $size = [
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm leading-4',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-2 text-base',
        'xl' => 'px-6 py-3 text-base'
    ][$size ?? 'md']
@endphp

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => "inline-flex items-center justify-center $size border border-transparent rounded-md font-medium disabled:opacity-50 disabled:pointer-events-none transition"]) }}>
    {{ $slot }}
</button>
