<div {!! $attributes !!}>
    <div class="sm:hidden">
        <x-dropdown
            width="full"
            align="top"
        >
            <x-slot:trigger>
                <button
                    type="button"
                    class="relative w-full cursor-default rounded-md border border-slate-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 dark:focus:ring-offset-slate-800"
                >
                    @if(request()->routeIs('agent.settings.general'))
                        {{ __('General') }}
                    @elseif(request()->routeIs('agent.settings.layout'))
                        {{ __('Layout') }}
                    @elseif(request()->routeIs('agent.settings.ticket'))
                        {{ __('Ticket') }}
                    @elseif(request()->routeIs('agent.settings.notification'))
                        {{ __('Notification') }}
                    @elseif(request()->routeIs('agent.settings.envato'))
                        {{ __('Envato Integration') }}
                    @elseif(request()->routeIs('agent.settings.license'))
                        {{ __('License Activation') }}
                    @else
                        {{ __('Please select an option') }}
                    @endif
                    <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-3">
                        <x-heroicon-m-chevron-up-down class="h-5 w-5 text-slate-400" />
                    </span>
                </button>
            </x-slot:trigger>
            <x-slot:content>
                <x-dropdown-link href="{{ route('agent.settings.general') }}">
                    {{ __('General') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('agent.settings.layout') }}">
                    {{ __('Layout') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('agent.settings.ticket') }}">
                    {{ __('Ticket') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('agent.settings.notification') }}">
                    {{ __('Notification') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('agent.settings.envato') }}">
                    {{ __('Envato Integration') }}
                </x-dropdown-link>
                <x-dropdown-link href="{{ route('agent.settings.license') }}">
                    {{ __('License Activation') }}
                </x-dropdown-link>
            </x-slot:content>
        </x-dropdown>
    </div>

    <div class="hidden sm:block">
        <div class="border-b border-slate-200 dark:border-slate-600">
            <nav
                class="-mb-px flex space-x-8"
                aria-label="Tabs"
            >
                <a
                    href="{{ route('agent.settings.general') }}"
                    @class(['whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm', 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => request()->routeIs('agent.settings.general'), 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 dark:hover:border-slate-300' => !request()->routeIs('agent.settings.general')])
                >
                    {{ __('General') }}
                </a>
                <a
                    href="{{ route('agent.settings.layout') }}"
                    @class(['whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm', 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => request()->routeIs('agent.settings.layout'), 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 dark:hover:border-slate-300' => !request()->routeIs('agent.settings.layout')])
                >
                    {{ __('Layout') }}
                </a>
                <a
                    href="{{ route('agent.settings.ticket') }}"
                    @class(['whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm', 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => request()->routeIs('agent.settings.ticket'), 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:border-slate-300' => !request()->routeIs('agent.settings.ticket')])
                >
                    {{ __('Ticket') }}
                </a>
                <a
                    href="{{ route('agent.settings.notification') }}"
                    @class(['whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm', 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => request()->routeIs('agent.settings.notification'), 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:border-slate-300' => !request()->routeIs('agent.settings.notification')])
                >
                    {{ __('Notification') }}
                </a>
                <a
                    href="{{ route('agent.settings.envato') }}"
                    @class(['whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm', 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => request()->routeIs('agent.settings.envato'), 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:border-slate-300' => !request()->routeIs('agent.settings.envato')])
                >
                    {{ __('Envato Integration') }}
                </a>
                <a
                    href="{{ route('agent.settings.license') }}"
                    @class(['whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm', 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => request()->routeIs('agent.settings.license'), 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-200 dark:hover:border-slate-300' => !request()->routeIs('agent.settings.license')])
                >
                    {{ __('License Activation') }}
                </a>
            </nav>
        </div>
    </div>
</div>
