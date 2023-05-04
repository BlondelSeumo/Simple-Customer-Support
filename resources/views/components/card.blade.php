<div {{ $attributes->merge(['class' => 'bg-white ring-1 ring-slate-300 sm:rounded-lg dark:bg-transparent dark:ring-slate-600']) }}>
    @isset($header)
        <div {{ $header->attributes->class(['border-b border-slate-300 px-4 py-5 sm:px-6 dark:border-slate-600']) }}>
            {{ $header }}
        </div>
    @endisset
    <div {{ $content->attributes->class(['px-4 py-6 sm:p-6']) }}>
        {{ $content }}
    </div>
    @isset($footer)
        <div {{ $footer->attributes->class(['border-t border-slate-300 px-4 py-3 sm:px-6 dark:border-slate-600']) }}>
            {{ $footer }}
        </div>
    @endisset
</div>
