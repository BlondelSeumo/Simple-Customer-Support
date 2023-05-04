<div style="color-scheme: dark;">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div
        x-cloak
        x-show="open"
        class="relative z-40 lg:hidden"
        role="dialog"
        aria-modal="true"
    >
        <div
            x-show="open"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-on:click="open = false"
            class="fixed inset-0 bg-slate-600 bg-opacity-75"
        ></div>

        <div class="fixed inset-0 flex z-40">
            <div
                x-show="open"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                x-on:click.away="open = false"
                class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-slate-800"
            >
                <div
                    x-show="open"
                    x-transition:enter="ease-in-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in-out duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute top-0 right-0 -mr-12 pt-2"
                >
                    <button
                        x-on:click="open = false"
                        type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    >
                        <span class="sr-only">{{ __('Close sidebar') }}</span>
                        <x-heroicon-o-x-mark class="h-6 w-6 text-white" />
                    </button>
                </div>

                <div class="flex-shrink-0 flex items-center px-4">
                    <a
                        href="{{ route('agent.dashboard') }}"
                        class="flex items-center"
                    >
                        <img
                            src="{{ $generalSettings->logo_path ? Storage::url($generalSettings->logo_path) : asset('img/logo-white-full.png') }}"
                            alt="{{ $generalSettings->site_name ?: config('app.name', 'Ticksify') }}"
                            class="h-8 w-auto"
                        >
                    </a>
                </div>
                <div class="mt-5 flex-1 h-0 overflow-y-auto">
                    <nav class="px-2 py-4">
                        <a
                            href="{{ route('agent.dashboard') }}"
                            class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.dashboard') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                        >
                            <x-heroicon-o-arrow-trending-up
                                class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.dashboard') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                aria-hidden="true"
                            />
                            {{ __('Dashboard') }}
                        </a>
                        @if(auth()->user()->is_admin)
                            <a
                                href="{{ route('agent.settings.general') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.settings.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                            >
                                <x-heroicon-o-cog-8-tooth
                                    aria-hidden="true"
                                    class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.settings.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                />
                                {{ __('Preferences') }}
                            </a>
                        @endif
                        <div class="mt-10">
                            <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                {{ __('Tickets') }}
                            </p>
                            <div class="mt-2 space-y-1">
                                <a
                                    href="{{ route('agent.tickets.list') }}"
                                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.tickets.*') && !request()->filled('status') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-inbox-stack
                                        class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.tickets.*') && !request()->filled('status') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        aria-hidden="true"
                                    />
                                    <span class="truncate">{{ __('All') }}</span>
                                </a>

                                @foreach(\App\Enums\TicketStatus::cases() as $status)
                                    <a
                                        href="{{ route('agent.tickets.list', ['status' => $status]) }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->fullUrl() == route('agent.tickets.list', ['status' => $status]) ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                    >
                                        <x-heroicon-o-inbox
                                            class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->fullUrl() == route('agent.tickets.list', ['status' => $status]) ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                            aria-hidden="true"
                                        />
                                        <span class="flex-1">{{ $status->label() }}</span>
                                        @if($status === \App\Enums\TicketStatus::OPEN)
                                            <span
                                                class="ml-3 inline-block py-0.5 px-3 text-xs font-medium rounded-full {{ request()->fullUrl() == route('agent.tickets.list', ['status' => $status]) ? 'bg-slate-800 text-white' : 'bg-slate-900 group-hover:bg-slate-800' }}"
                                                data-tippy-content="{{ auth()->user()->is_admin ? __('Assigned/Total') : __('Assigned') }}"
                                                data-tippy-placement="right"
                                            >
                                            {{ $this->assigned_open_tickets_count }}
                                                @if(auth()->user()->is_admin)
                                                    / {{ $this->total_open_tickets_count }}
                                                @endif
                                            </span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-10">
                            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                {{ __('Knowledge Base') }}
                            </p>
                            <div class="mt-2 space-y-1">
                                <a
                                    href="{{ route('agent.articles.list') }}"
                                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.articles.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-newspaper
                                        class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.articles.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        aria-hidden="true"
                                    />
                                    {{ __('Articles') }}
                                </a>
                                <a
                                    href="{{ route('agent.collections.list') }}"
                                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.collections.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-clipboard-document-list
                                        class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.collections.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        aria-hidden="true"
                                    />
                                    {{ __('Collections') }}
                                </a>
                            </div>
                        </div>
                        @if(auth()->user()->is_admin)
                            <div class="mt-10">
                                <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                    {{ __('Resources') }}
                                </p>
                                <div class="mt-2 space-y-1">
                                    <a
                                        href="{{ route('agent.users.list') }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.users.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                    >
                                        <x-heroicon-o-user-group
                                            aria-hidden="true"
                                            class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.users.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        />
                                        {{ __('Users') }}
                                    </a>
                                    <a
                                        href="{{ route('agent.agents.list') }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.agents.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                    >
                                        <x-heroicon-o-identification
                                            aria-hidden="true"
                                            class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.agents.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        />
                                        {{ __('Agents') }}
                                    </a>
                                    <a
                                        href="{{ route('agent.labels') }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.labels') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                    >
                                        <x-heroicon-o-tag
                                            aria-hidden="true"
                                            class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.labels') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        />
                                        {{ __('Labels') }}
                                    </a>
                                    <a
                                        href="{{ route('agent.products') }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.products') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                    >
                                        <x-heroicon-o-cube
                                            aria-hidden="true"
                                            class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.products') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        />
                                        {{ __('Products') }}
                                    </a>
                                    <a
                                        href="{{ route('agent.categories') }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.categories') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                    >
                                        <x-heroicon-o-list-bullet
                                            aria-hidden="true"
                                            class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.categories') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                        />
                                        {{ __('Categories') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </nav>
                </div>
            </div>

            <div
                class="flex-shrink-0 w-14"
                aria-hidden="true"
            >
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </div>
    </div>
    <!-- Static sidebar for desktop -->
    <div class="hidden lg:flex lg:w-64 lg:fixed lg:inset-y-0">
        <div class="flex-1 flex flex-col min-h-0 dark:border-r dark:border-slate-600">
            <div class="flex h-16 flex-shrink-0 px-4 bg-slate-800">
                <a
                    href="{{ route('agent.dashboard') }}"
                    class="flex items-center"
                >
                    <img
                        src="{{ $generalSettings->logo_path ? Storage::url($generalSettings->logo_path) : asset('img/logo-white-full.png') }}"
                        alt="{{ $generalSettings->site_name ?: config('app.name', 'Ticksify') }}"
                        class="h-10 w-auto"
                    >
                </a>
            </div>
            <div class="flex-1 flex flex-col overflow-y-auto bg-slate-800">
                <nav class="flex-1 px-2 py-4">
                    @unless($this->isLocal || $this->isStaging)
                        @if(!$this->isLicenseActivated)
                            <a
                                href="{{ route('agent.settings.license') }}"
                                class="mb-5 group flex items-center px-3 py-2 text-sm font-medium rounded-md bg-slate-700 text-red-500"
                                data-tippy-content="Click to activate your license"
                                data-tippy-placement="right"
                            >
                                <x-heroicon-m-exclamation-triangle class="animate-pulse inline-block h-6 w-6 mr-3" />
                                {{ __('Unregistered') }}
                            </a>
                        @endif
                    @endunless
                    <a
                        href="{{ route('agent.dashboard') }}"
                        class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.dashboard') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                    >
                        <x-heroicon-o-arrow-trending-up
                            aria-hidden="true"
                            class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.dashboard') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                        />
                        {{ __('Dashboard') }}
                    </a>
                    @if(auth()->user()->is_admin)
                        <a
                            href="{{ route('agent.settings.general') }}"
                            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.settings.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                        >
                            <x-heroicon-o-cog-8-tooth
                                aria-hidden="true"
                                class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.settings.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                            />
                            {{ __('Preferences') }}
                        </a>
                    @endif
                    <div class="mt-10">
                        <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            {{ __('Tickets') }}
                        </p>
                        <div class="mt-2 space-y-1">
                            <a
                                href="{{ route('agent.tickets.list') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.tickets.*') && !request()->filled('status') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                            >
                                <x-heroicon-o-inbox-stack
                                    aria-hidden="true"
                                    class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.tickets.*') && !request()->filled('status') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                />
                                <span class="flex-1">{{ __('All') }}</span>
                            </a>
                            @foreach(\App\Enums\TicketStatus::cases() as $status)
                                <a
                                    href="{{ route('agent.tickets.list', ['status' => $status]) }}"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->fullUrl() == route('agent.tickets.list', ['status' => $status]) ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-inbox
                                        aria-hidden="true"
                                        class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->fullUrl() == route('agent.tickets.list', ['status' => $status]) ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                    />
                                    <span class="flex-1">{{ $status->label() }}</span>
                                    @if($status === \App\Enums\TicketStatus::OPEN)
                                        <span
                                            class="ml-3 inline-block py-0.5 px-3 text-xs font-medium rounded-full {{ request()->fullUrl() == route('agent.tickets.list', ['status' => $status]) ? 'bg-slate-800 text-white' : 'bg-slate-900 group-hover:bg-slate-800' }}"
                                            data-tippy-content="{{ auth()->user()->is_admin ? __('Assigned/Total') : __('Assigned') }}"
                                            data-tippy-placement="right"
                                        >
                                            {{ $this->assigned_open_tickets_count }}
                                            @if(auth()->user()->is_admin)
                                                / {{ $this->total_open_tickets_count }}
                                            @endif
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-10">
                        <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            {{ __('Knowledge Base') }}
                        </p>
                        <div class="mt-2 space-y-1">
                            <a
                                href="{{ route('agent.articles.list') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.articles.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                            >
                                <x-heroicon-o-newspaper
                                    aria-hidden="true"
                                    class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.articles.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                />
                                {{ __('Articles') }}
                            </a>
                            <a
                                href="{{ route('agent.collections.list') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.collections.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                            >
                                <x-heroicon-o-clipboard-document-list
                                    aria-hidden="true"
                                    class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.collections.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                />
                                {{ __('Collections') }}
                            </a>
                        </div>
                    </div>
                    @if(auth()->user()->is_admin)
                        <div class="mt-10">
                            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                {{ __('Resources') }}
                            </p>
                            <div class="mt-2 space-y-1">
                                <a
                                    href="{{ route('agent.users.list') }}"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.users.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-user-group
                                        aria-hidden="true"
                                        class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.users.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                    />
                                    {{ __('Users') }}
                                </a>
                                <a
                                    href="{{ route('agent.agents.list') }}"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.agents.*') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-identification
                                        aria-hidden="true"
                                        class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.agents.*') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                    />
                                    {{ __('Agents') }}
                                </a>
                                <a
                                    href="{{ route('agent.labels') }}"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.labels') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-tag
                                        aria-hidden="true"
                                        class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.labels') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                    />
                                    {{ __('Labels') }}
                                </a>
                                <a
                                    href="{{ route('agent.products') }}"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.products') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-cube
                                        aria-hidden="true"
                                        class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.products') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                    />
                                    {{ __('Products') }}
                                </a>
                                <a
                                    href="{{ route('agent.categories') }}"
                                    class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('agent.categories') ? 'bg-slate-900 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
                                >
                                    <x-heroicon-o-list-bullet
                                        aria-hidden="true"
                                        class="group-hover:text-slate-300 mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('agent.categories') ? 'text-slate-300' : 'text-slate-400 group-hover:text-slate-300' }}"
                                    />
                                    {{ __('Categories') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</div>
