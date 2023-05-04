@props(['disabled' => false, 'type' => 'checkbox'])

<input type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:ring-blue-500 h-4 w-4 text-blue-600 border-slate-300 rounded']) !!}>
