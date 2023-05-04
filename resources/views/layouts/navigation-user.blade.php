<aside
    wire:ignore
    class="py-6 lg:col-span-3"
>
    <nav class="space-y-1">
        <a
            href="{{ route('user.profile') }}"
            @class(['group border-l-4 px-3 py-2 flex items-center text-sm font-medium', 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' => request()->routeIs('user.profile'), 'border-transparent text-slate-900 hover:bg-slate-50 hover:text-slate-900' => !request()->routeIs('user.profile')])
        >
            <x-heroicon-o-user-circle @class(['flex-shrink-0 -ml-1 mr-3 h-6 w-6', 'text-blue-500 group-hover:text-blue-500' =>request()->routeIs('user.profile'), 'text-slate-400 group-hover:text-slate-500' => !request()->routeIs('user.profile')]) />
            <span class="truncate">{{ __('Profile') }}</span>
        </a>
        <a
            href="{{ route('user.tickets.list') }}"
            @class(['group border-l-4 px-3 py-2 flex items-center text-sm font-medium', 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' => request()->routeIs('user.tickets.*'), 'border-transparent text-slate-900 hover:bg-slate-50 hover:text-slate-900' => !request()->routeIs('user.tickets.*')])
        >
            <x-heroicon-o-inbox-stack @class(['flex-shrink-0 -ml-1 mr-3 h-6 w-6', 'text-blue-500 group-hover:text-blue-500' =>request()->routeIs('user.tickets.*'), 'text-slate-400 group-hover:text-slate-500' => !request()->routeIs('user.tickets.*')]) />
            <span class="truncate">{{ __('Tickets') }}</span>
        </a>
    </nav>
</aside>
