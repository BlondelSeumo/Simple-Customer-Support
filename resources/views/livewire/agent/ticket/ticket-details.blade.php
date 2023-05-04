<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 xl:max-w-7xl xl:grid xl:grid-cols-3">
        <div class="xl:col-span-2 xl:pr-8 xl:border-r xl:border-slate-200 dark:xl:border-slate-600">
            <div>
                <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:border-slate-200 xl:pb-6 dark:xl:border-slate-600">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-200">
                            {{ $ticket->subject }}
                        </h1>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                            #{{ $ticket->id }} {{ __('opened by') }}
                            <a
                                href="{{ route('agent.users.details', $ticket->user->id) }}"
                                class="font-medium text-slate-900 hover:text-blue-500 hover:underline dark:text-slate-200 dark:hover:text-blue-400"
                            >
                                {{ $ticket->user->name }}
                            </a>
                            {{ __('in') }}
                            <a
                                href="{{ route('agent.tickets.list', ['category' => $ticket->category->slug]) }}"
                                class="font-medium text-slate-900 hover:text-blue-500 hover:underline dark:text-slate-200 dark:hover:text-blue-400"
                            >
                                {{ $ticket->category->name }}
                            </a>
                        </p>
                    </div>
                    <div class="mt-4 flex space-x-3 md:mt-0">
                        <a
                            href="{{ route('agent.tickets.edit', $ticket) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-500 dark:hover:text-slate-200 dark:focus:ring-offset-slate-800"
                        >
                            <x-heroicon-m-pencil class="-ml-1 mr-2 w-5 h-5 text-slate-400" />
                            <span>{{ __('Edit') }}</span>
                        </a>
                        <x-button.primary
                            x-on:click="$dispatch('show-comment-form')"
                            type="button"
                        >
                            <x-heroicon-m-arrow-uturn-left class="-ml-1 mr-2 w-5 h-5 text-white" />
                            {{ __('Reply') }}
                        </x-button.primary>
                    </div>
                </div>
                <!-- Ticket information on mobile -->
                <aside class="mt-8 xl:hidden">
                    <h2 class="sr-only">
                        {{ __('Details') }}
                    </h2>
                    <!-- General information -->
                    <div class="space-y-5">
                        <!-- Status -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                @if($ticket->status === \App\Enums\TicketStatus::CLOSED)
                                    <x-heroicon-s-lock-closed class="h-5 w-5 text-slate-400" />
                                @elseif($ticket->status === \App\Enums\TicketStatus::SOLVED)
                                    <x-heroicon-s-check-circle class="h-5 w-5 text-green-500" />
                                @else
                                    <x-heroicon-s-lock-open class="h-5 w-5 text-green-500" />
                                @endif
                                <span class="text-slate-900 text-sm font-medium dark:text-slate-200">{{ $ticket->status->label() }}</span>
                            </div>
                            <x-dropdown :width="80">
                                <x-slot:trigger>
                                    <button
                                        type="button"
                                        class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                    >
                                        <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                    </button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                                        {{ __('Update ticket status') }}
                                    </div>
                                    <div class="relative max-h-64 overflow-y-auto">
                                        @foreach(\App\Enums\TicketStatus::cases() as $status)
                                            <x-dropdown-link
                                                wire:click="updateTicketStatus('{{ $status->value }}')"
                                                role="button"
                                            >
                                                {{ $status->label() }}
                                            </x-dropdown-link>
                                        @endforeach
                                    </div>
                                </x-slot:content>
                            </x-dropdown>
                        </div>
                        <!-- Priority -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <x-heroicon-s-flag
                                    class="h-5 w-5"
                                    style="color: {{ $ticket->priority->color() }}"
                                />
                                <span class="text-slate-900 text-sm font-medium dark:text-slate-200">
                                    {{ trans(':level priority', ['level' => $ticket->priority->label()]) }}
                                </span>
                            </div>
                            <x-dropdown :width="80">
                                <x-slot:trigger>
                                    <button
                                        type="button"
                                        class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                    >
                                        <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                    </button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                                        {{ __('Update ticket priority') }}
                                    </div>
                                    <div class="relative max-h-64 overflow-y-auto">
                                        @foreach(\App\Enums\TicketPriority::cases() as $priority)
                                            <x-dropdown-link
                                                wire:click="updateTicketPriority('{{ $priority->value }}')"
                                                role="button"
                                            >
                                                {{ $priority->label() }}
                                            </x-dropdown-link>
                                        @endforeach
                                    </div>
                                </x-slot:content>
                            </x-dropdown>
                        </div>
                        <!-- Comment count -->
                        <div class="flex items-center space-x-2">
                            <x-heroicon-s-chat-bubble-left-ellipsis class="h-5 w-5 text-slate-400" />
                            <span class="text-slate-900 text-sm font-medium dark:text-slate-200">
                                {{ trans_choice(':count comment|:count comments', $this->comments_count) }}
                            </span>
                        </div>
                        <!-- Create date -->
                        <div class="flex items-center space-x-2">
                            <x-heroicon-s-calendar-days class="h-5 w-5 text-slate-400" />
                            <span class="text-slate-900 text-sm font-medium dark:text-slate-200">{{ __('Created on') }} <time datetime="{{ $ticket->created_at->toIso8601ZuluString() }}">{{ $ticket->created_at->toFormattedDateString() }}</time></span>
                        </div>
                    </div>
                    <!-- Assignees & Labels -->
                    <div class="mt-6 border-t border-slate-200 py-6 space-y-8 dark:border-slate-600">
                        <!-- Product -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('Product') }}
                                </h2>
                            </div>
                            <div class="mt-2 flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <x-heroicon-m-cube class="h-5 w-5 text-slate-400" />
                                </div>
                                <div class="text-sm font-medium text-slate-900 dark:text-slate-200">
                                    {{ $ticket->product->name }}
                                </div>
                            </div>
                        </div>
                        <!-- License -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('License') }}
                                </h2>
                                @if(auth()->user()->is_admin || $this->ticketSettings->allow_agent_to_see_license_code)
                                    <x-dropdown
                                        :width="80"
                                        :close-on-click="false"
                                    >
                                        <x-slot:trigger>
                                            <button
                                                type="button"
                                                class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                            >
                                                <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                            </button>
                                        </x-slot:trigger>
                                        <x-slot:content>
                                            <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                                                {{ __('Update license code for this ticket') }}
                                            </div>
                                            <div class="px-4 py-2">
                                                <form wire:submit.prevent="updateTicketLicenseCode">
                                                    <fieldset
                                                        wire:target="updateTicketLicenseCode, verifyTicketLicenseCode"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <x-label
                                                            for="licenseCodeInput"
                                                            value="{{ __('License code') }}"
                                                            class="sr-only"
                                                        />
                                                        <x-input
                                                            wire:model.defer="ticket.license_code"
                                                            type="text"
                                                            id="licenseCodeInput"
                                                            class="mt-1 text-sm"
                                                            placeholder="{{ __('License code') }}"
                                                        />
                                                        <x-input-error
                                                            for="ticket.license_code"
                                                            class="mt-2"
                                                        />
                                                        @if($this->envatoSettings->token_enabled && $ticket->product->is_from_envato)
                                                            <x-button.secondary
                                                                wire:click="updateTicketLicenseCode(true)"
                                                                size="xs"
                                                                class="block w-full mt-2"
                                                            >
                                                                {{ __('Verify and Save') }}
                                                            </x-button.secondary>
                                                            <x-button.primary
                                                                size="xs"
                                                                class="block w-full mt-2"
                                                            >
                                                                {{ __('Save without Verification') }}
                                                            </x-button.primary>
                                                        @else
                                                            <x-button.primary
                                                                size="xs"
                                                                class="block w-full mt-2"
                                                            >
                                                                {{ __('Save changes') }}
                                                            </x-button.primary>
                                                        @endif
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </x-slot:content>
                                    </x-dropdown>
                                @endif
                            </div>
                            <div @class(['mt-2 text-sm', 'font-medium text-slate-900 dark:text-slate-200' => $ticket->license_code, 'text-slate-500 dark:text-slate-400' => !$ticket->license_code])>
                                @if($ticket->license_code)
                                    <div class="flex items-start space-x-2">
                                        <x-heroicon-m-key class="h-5 w-5 text-slate-400" />
                                        <span>{{ auth()->user()->is_admin || $this->ticketSettings->allow_agent_to_see_license_code ? $ticket->license_code : '**********' }}</span>
                                    </div>
                                    @if($ticket->product->provider === \App\Enums\ProductProvider::ENVATO)
                                        <div class="mt-4">
                                            @if($ticket->has_valid_license && $ticket->has_active_support)
                                                <div class="rounded-md bg-green-50 p-4">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0">
                                                            <x-heroicon-m-check-circle class="h-5 w-5 text-green-400" />
                                                        </div>
                                                        <div class="ml-3">
                                                            <h3 class="text-sm font-medium text-green-800">
                                                                {{ __('Active support') }}
                                                            </h3>
                                                            <div class="mt-2 text-sm text-green-700">
                                                                <p>{{ __('This license code is valid and has active support until :date.', ['date' => $this->ticket->license_support_ends_at]) }}</p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <x-button.text
                                                                    wire:click.prevent="$set('showLicenseDetails', true)"
                                                                    class="!px-0 !py-0"
                                                                >
                                                                    {{ __('View license details') }}
                                                                </x-button.text>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($ticket->has_valid_license && !$ticket->has_active_support)
                                                <div class="rounded-md bg-yellow-50 p-4">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0">
                                                            <x-heroicon-m-exclamation-triangle class="h-5 w-5 text-yellow-400" />
                                                        </div>
                                                        <div class="ml-3">
                                                            <h3 class="text-sm font-medium text-yellow-800">
                                                                {{ __('Support expired') }}
                                                            </h3>
                                                            <div class="mt-2 text-sm text-yellow-700">
                                                                <p>{{ __('This license code is valid but the support has expired on :date.', ['date' => $this->ticket->license_support_ends_at]) }}</p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <x-button.text
                                                                    wire:click.prevent="$set('showLicenseDetails', true)"
                                                                    class="!px-0 !py-0"
                                                                >
                                                                    {{ __('View license details') }}
                                                                </x-button.text>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="rounded-md bg-red-50 p-4">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0">
                                                            <x-heroicon-m-x-circle class="h-5 w-5 text-red-400" />
                                                        </div>
                                                        <div class="ml-3">
                                                            <h3 class="text-sm font-medium text-red-800">
                                                                {{ __('Unverified') }}
                                                            </h3>
                                                            <div class="mt-2 text-sm text-red-700">
                                                                <p>{{ __('This license code is added without verification or has been revoked.') }}</p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <x-button.text
                                                                    wire:click.prevent="$set('showLicenseDetails', true)"
                                                                    class="!px-0 !py-0"
                                                                >
                                                                    {{ __('View license details') }}
                                                                </x-button.text>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    {{ __('None yet') }}
                                @endif
                            </div>
                        </div>
                        <!-- Assignees -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('Assignees') }}
                                </h2>
                                @if(auth()->user()->is_admin || $this->ticketSettings->allow_agent_to_assign_ticket)
                                    <x-dropdown
                                        :width="80"
                                        :close-on-click="false"
                                    >
                                        <x-slot:trigger>
                                            <button
                                                type="button"
                                                class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                            >
                                                <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                            </button>
                                        </x-slot:trigger>
                                        <x-slot:content>
                                            <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                                                {{ __('Assign people to this ticket') }}
                                            </div>
                                            <div class="px-4 py-2 border-b border-slate-200 dark:border-slate-600">
                                                <x-input
                                                    wire:model.debounce.500ms="filters.agentName"
                                                    type="search"
                                                    class="text-sm"
                                                    :placeholder="__('Type or choose an agent')"
                                                />
                                            </div>
                                            <div
                                                wire:target="filters.agentName"
                                                wire:loading.delay.class="opacity-25"
                                                class="relative max-h-64 overflow-y-auto"
                                            >
                                                @forelse($this->agents as $agent)
                                                    <x-dropdown-link
                                                        wire:click="toggleAssignee('{{ $agent->id }}')"
                                                        role="button"
                                                        class="relative"
                                                    >
                                                        <div class="flex items-center">
                                                            <img
                                                                src="{{ $agent->getFirstMediaUrl('avatar') }}"
                                                                alt="{{ __('Avatar') }}"
                                                                class="flex-shrink-0 h-6 w-6 bg-white rounded-full"
                                                            >
                                                            <span @class(['ml-3 block truncate', 'font-normal' => !in_array($agent->id, $ticket->assignees->pluck('id')->toArray()), 'font-semibold' => in_array($agent->id, $ticket->assignees->pluck('id')->toArray())])>
                                                                {{ $agent->name }}
                                                            </span>
                                                        </div>
                                                        @if(in_array($agent->id, $ticket->assignees->pluck('id')->toArray()))
                                                            <span class="text-blue-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                                                <x-heroicon-m-check class="w-5 h-5" />
                                                            </span>
                                                        @endif
                                                    </x-dropdown-link>
                                                @empty
                                                    <div class="px-4 py-2 text-sm leading-5 text-slate-700 dark:text-slate-400">
                                                        {{ __('No agents found') }}
                                                    </div>
                                                @endforelse
                                            </div>
                                        </x-slot:content>
                                    </x-dropdown>
                                @endif
                            </div>
                            <ul
                                role="list"
                                class="mt-3 space-y-3"
                            >
                                @forelse($ticket->assignees as $agent)
                                    <li class="flex justify-start">
                                        <a
                                            href="#"
                                            class="flex items-center space-x-3"
                                        >
                                            <div class="flex-shrink-0">
                                                <img
                                                    src="{{ $agent->getFirstMediaUrl('avatar') }}"
                                                    alt="{{ __('Avatar') }}"
                                                    class="w-5 h-5 bg-white rounded-full dark:bg-slate-800"
                                                >
                                            </div>
                                            <div class="text-sm font-medium text-slate-900 dark:text-slate-200">
                                                {{ $agent->name }}
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="flex justify-start">
                                        <div class="text-sm text-slate-500 dark:text-slate-400">
                                            {{ __('No one -') }}
                                            <button
                                                wire:click="toggleAssignee({{ auth()->user() }})"
                                                class="hover:text-blue-500 dark:text-slate-400"
                                            >
                                                {{ __('assign your self') }}
                                            </button>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- Labels -->
                        <div>
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('Labels') }}
                                </h2>
                                <x-dropdown
                                    :width="80"
                                    :close-on-click="false"
                                >
                                    <x-slot:trigger>
                                        <button
                                            type="button"
                                            class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                        >
                                            <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                        </button>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                                            {{ __('Apply labels to this ticket') }}
                                        </div>
                                        <div class="px-4 py-2 border-b border-slate-200 dark:border-slate-600">
                                            <x-input
                                                wire:model.debounce.500ms="filters.labelName"
                                                type="search"
                                                class="text-sm"
                                                :placeholder="__('Filter labels')"
                                            />
                                        </div>
                                        <div
                                            wire:target="filters.labelName"
                                            wire:loading.delay.class="opacity-25"
                                            class="relative max-h-64 overflow-y-auto"
                                        >
                                            @forelse($this->labels as $label)
                                                <x-dropdown-link
                                                    wire:click="toggleLabel('{{ $label->id }}')"
                                                    role="button"
                                                    class="relative"
                                                >
                                                    <div class="flex flex-col">
                                                        <div class="flex items-center justify-between">
                                                            <p class="flex items-center">
                                                                <span
                                                                    class="flex-shrink-0 inline-block h-2 w-2 rounded-full"
                                                                    style="background-color: {{ '#' . $label->color }}"
                                                                    aria-hidden="true"
                                                                ></span>
                                                                <span @class(['text-slate-700 ml-1 truncate dark:text-slate-200', 'font-semibold' => in_array($label->id, $ticket->labels->pluck('id')->toArray())])>
                                                                    {{ $label->name }}
                                                                </span>
                                                            </p>
                                                            @if(in_array($label->id, $ticket->labels->pluck('id')->toArray()))
                                                                <span class="text-blue-500">
                                                                    <x-heroicon-m-check class="h-5 w-5" />
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <p class="text-slate-500 truncate pr-5 dark:text-slate-400">
                                                            {{ $label->description }}
                                                        </p>
                                                    </div>
                                                </x-dropdown-link>
                                            @empty
                                                @if($filters['labelName'])
                                                    <x-dropdown-link
                                                        wire:click="createNewLabel"
                                                        role="button"
                                                        class="relative"
                                                    >
                                                        {{ __('Create new label ":name"', ['name' => $filters['labelName']]) }}
                                                    </x-dropdown-link>
                                                @else
                                                    <div class="px-4 py-2 text-sm leading-5 text-slate-700 dark:text-slate-400">
                                                        {{ __('No labels found') }}
                                                    </div>
                                                @endif
                                            @endforelse
                                        </div>
                                    </x-slot:content>
                                </x-dropdown>
                            </div>
                            <ul
                                role="list"
                                class="mt-2 leading-8"
                            >
                                @forelse($ticket->labels as $label)
                                    <li class="inline">
                                        <a
                                            href="{{ route('agent.tickets.list', ['label' => $label->slug]) }}"
                                            class="relative inline-flex items-center rounded-full border border-slate-300 px-3 py-0.5 hover:border-slate-400 dark:border-slate-600 dark:hover:border-slate-500"
                                            title="{{ $label->description }}"
                                        >
                                            <div class="absolute flex-shrink-0 flex items-center justify-center">
                                                <span
                                                    class="h-1.5 w-1.5 rounded-full"
                                                    style="background-color: {{ '#' . $label->color }}"
                                                    aria-hidden="true"
                                                ></span>
                                            </div>
                                            <div class="ml-3.5 text-sm font-medium text-slate-900 dark:text-slate-200">
                                                {{ $label->name }}
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <div class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ __('None yet') }}
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- Ticket deletion -->
                    <div
                        x-data="{ confirmingTicketDeletion: false }"
                        class="border-y border-slate-200 py-6 dark:border-slate-600"
                    >
                        <div
                            x-cloak
                            x-show="confirmingTicketDeletion"
                            class="flex items-center justify-between space-x-2"
                        >
                            <x-button.secondary
                                x-on:click="confirmingTicketDeletion = false"
                                class="w-full"
                            >
                                {{ __('Cancel') }}
                            </x-button.secondary>
                            <x-button.danger
                                wire:click="deleteTicket"
                                class="w-full"
                            >
                                {{ __('Delete') }}
                            </x-button.danger>
                        </div>
                        <div x-show="!confirmingTicketDeletion">
                            <x-button.soft-danger
                                x-on:click="confirmingTicketDeletion = true"
                                class="w-full"
                            >
                                {{ __('Delete ticket') }}
                            </x-button.soft-danger>
                        </div>
                    </div>
                </aside>
                <!-- Ticket content-->
                <div class="py-3 xl:pt-6 xl:pb-0">
                    <h2 class="sr-only">
                        {{ __('Content') }}
                    </h2>
                    <div class="prose prose-slate max-w-none break-words dark:prose-invert">
                        {!! $ticket->content !!}
                    </div>
                </div>
                <!-- Ticket attachment-->
                @if($ticket->hasMedia('attachments'))
                    <div class="py-3 xl:pt-6 xl:pb-0">
                        <livewire:attachment-list :model="$ticket" />
                    </div>
                @endif
            </div>
            <!-- Conversation -->
            <section
                aria-labelledby="activity-title"
                class="mt-8 xl:mt-10"
            >
                <div class="divide-y divide-slate-200 dark:divide-slate-600">
                    <div class="pb-4 flex items-center justify-between">
                        <h2
                            id="activity-title"
                            class="text-lg font-medium text-slate-900 dark:text-slate-200"
                        >
                            {{ __('Conversation') }}
                        </h2>
                        <div class="flex items-center space-x-3">
                            <x-button.secondary x-on:click="$dispatch('toggle-filter')">
                                <x-heroicon-m-funnel class="-ml-0.5 mr-2 h-4 w-4" />
                                Filters
                            </x-button.secondary>
                        </div>
                    </div>
                    <div class="pt-6">
                        <!-- Conversation feed-->
                        <div class="flow-root">
                            <livewire:ticket-comment-list :ticket="$ticket" />
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Ticket information on desktop -->
        <aside class="hidden xl:block xl:pl-8">
            <h2 class="sr-only">{{ __('Details') }}</h2>
            <!-- General information -->
            <div class="space-y-5">
                <!-- Status -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        @if($ticket->status === \App\Enums\TicketStatus::CLOSED)
                            <x-heroicon-s-lock-closed class="h-5 w-5 text-slate-400" />
                        @elseif($ticket->status === \App\Enums\TicketStatus::SOLVED)
                            <x-heroicon-s-check-circle class="h-5 w-5 text-green-500" />
                        @else
                            <x-heroicon-s-lock-open class="h-5 w-5 text-green-500" />
                        @endif
                        <span class="text-slate-900 text-sm font-medium dark:text-slate-200">{{ $ticket->status->label() }}</span>
                    </div>
                    <x-dropdown :width="80">
                        <x-slot:trigger>
                            <button
                                type="button"
                                class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                            >
                                <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                            </button>
                        </x-slot:trigger>
                        <x-slot:content>
                            <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:text-slate-200 dark:border-slate-600">
                                {{ __('Update ticket status') }}
                            </div>
                            <div class="relative max-h-64 overflow-y-auto">
                                @foreach(\App\Enums\TicketStatus::cases() as $status)
                                    <x-dropdown-link
                                        wire:click="updateTicketStatus('{{ $status->value }}')"
                                        role="button"
                                    >
                                        {{ $status->label() }}
                                    </x-dropdown-link>
                                @endforeach
                            </div>
                        </x-slot:content>
                    </x-dropdown>
                </div>
                <!-- Priority -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <x-heroicon-s-flag
                            class="h-5 w-5"
                            style="color: {{ $ticket->priority->color() }}"
                        />
                        <span class="text-slate-900 text-sm font-medium dark:text-slate-200">
                            {{ trans(':level priority', ['level' => $ticket->priority->label()]) }}
                        </span>
                    </div>
                    <x-dropdown :width="80">
                        <x-slot:trigger>
                            <button
                                type="button"
                                class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                            >
                                <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                            </button>
                        </x-slot:trigger>
                        <x-slot:content>
                            <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:text-slate-200 dark:border-slate-600">
                                {{ __('Update ticket priority') }}
                            </div>
                            <div class="relative max-h-64 overflow-y-auto">
                                @foreach(\App\Enums\TicketPriority::cases() as $priority)
                                    <x-dropdown-link
                                        wire:click="updateTicketPriority('{{ $priority->value }}')"
                                        role="button"
                                    >
                                        {{ $priority->label() }}
                                    </x-dropdown-link>
                                @endforeach
                            </div>
                        </x-slot:content>
                    </x-dropdown>
                </div>
                <!-- Comment count -->
                <div class="flex items-center space-x-2">
                    <x-heroicon-s-chat-bubble-left-ellipsis class="h-5 w-5 text-slate-400" />
                    <span class="text-slate-900 text-sm font-medium dark:text-slate-200">{{ trans_choice(':count comment|:count comments', $this->comments_count) }}</span>
                </div>
                <!-- Create date -->
                <div class="flex items-center space-x-2">
                    <x-heroicon-s-calendar-days class="h-5 w-5 text-slate-400" />
                    <span class="text-slate-900 text-sm font-medium dark:text-slate-200">{{ __('Created on') }} <time datetime="{{ $ticket->created_at->toIso8601ZuluString() }}">{{ $ticket->created_at->toFormattedDateString() }}</time></span>
                </div>
            </div>
            <!-- Assignees & Labels -->
            <div class="mt-6 border-t border-slate-200 py-6 space-y-8 dark:border-slate-600">
                <!-- Product -->
                <div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Product') }}
                        </h2>
                    </div>
                    <div class="mt-2 flex items-start space-x-2">
                        <div class="flex-shrink-0">
                            <x-heroicon-m-cube class="h-5 w-5 text-slate-400" />
                        </div>
                        <div class="text-sm font-medium text-slate-900 dark:text-slate-200">
                            {{ $ticket->product->name }}
                        </div>
                    </div>
                </div>
                <!-- License -->
                <div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('License') }}
                        </h2>
                        @if(auth()->user()->is_admin || $this->ticketSettings->allow_agent_to_see_license_code)
                            <x-dropdown
                                :width="80"
                                :close-on-click="false"
                            >
                                <x-slot:trigger>
                                    <button
                                        type="button"
                                        class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                    >
                                        <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                    </button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:text-slate-200 dark:border-slate-600">
                                        {{ __('Update license code for this ticket') }}
                                    </div>
                                    <div class="px-4 py-2">
                                        <form wire:submit.prevent="updateTicketLicenseCode">
                                            <fieldset
                                                wire:target="updateTicketLicenseCode, verifyTicketLicenseCode"
                                                wire:loading.attr="disabled"
                                            >
                                                <x-label
                                                    for="licenseCodeInput"
                                                    value="{{ __('License code') }}"
                                                    class="sr-only"
                                                />
                                                <x-input
                                                    wire:model.defer="ticket.license_code"
                                                    type="text"
                                                    id="licenseCodeInput"
                                                    class="mt-1"
                                                    placeholder="{{ __('License code') }}"
                                                />
                                                <x-input-error
                                                    for="ticket.license_code"
                                                    class="mt-2"
                                                />
                                                @if($this->envatoSettings->token_enabled && $ticket->product->is_from_envato)
                                                    <x-button.secondary
                                                        wire:click="updateTicketLicenseCode(true)"
                                                        size="xs"
                                                        class="block w-full mt-2"
                                                    >
                                                        {{ __('Verify and Save') }}
                                                    </x-button.secondary>
                                                    <x-button.primary
                                                        size="xs"
                                                        class="block w-full mt-2"
                                                    >
                                                        {{ __('Save without Verification') }}
                                                    </x-button.primary>
                                                @else
                                                    <x-button.primary
                                                        size="xs"
                                                        class="block w-full mt-2"
                                                    >
                                                        {{ __('Save changes') }}
                                                    </x-button.primary>
                                                @endif
                                            </fieldset>
                                        </form>
                                    </div>
                                </x-slot:content>
                            </x-dropdown>
                        @endif
                    </div>
                    <div @class(['mt-2 text-sm', 'font-medium text-slate-900 dark:text-slate-200' => $ticket->license_code, 'text-slate-500 dark:text-slate-400' => !$ticket->license_code])>
                        @if($ticket->license_code)
                            <div class="flex items-start space-x-2">
                                <x-heroicon-m-key class="h-5 w-5 text-slate-400" />
                                <span>{{ auth()->user()->is_admin || $this->ticketSettings->allow_agent_to_see_license_code ? $ticket->license_code : '**********' }}</span>
                            </div>
                            @if($ticket->product->provider === \App\Enums\ProductProvider::ENVATO)
                                <div class="mt-4">
                                    @if($ticket->has_valid_license && $ticket->has_active_support)
                                        <div class="rounded-md bg-green-50 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <x-heroicon-m-check-circle class="h-5 w-5 text-green-400" />
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-green-800">
                                                        {{ __('Active support') }}
                                                    </h3>
                                                    <div class="mt-2 text-sm text-green-700">
                                                        <p>{{ __('This license code is valid and has active support until :date.', ['date' => $this->ticket->license_support_ends_at]) }}</p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <x-button.text
                                                            wire:click.prevent="$set('showLicenseDetails', true)"
                                                            class="!px-0 !py-0"
                                                        >
                                                            {{ __('View license details') }}
                                                        </x-button.text>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($ticket->has_valid_license && !$ticket->has_active_support)
                                        <div class="rounded-md bg-yellow-50 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <x-heroicon-m-exclamation-triangle class="h-5 w-5 text-yellow-400" />
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-yellow-800">
                                                        {{ __('Support expired') }}
                                                    </h3>
                                                    <div class="mt-2 text-sm text-yellow-700">
                                                        <p>{{ __('This license code is valid but the support has expired on :date.', ['date' => $this->ticket->license_support_ends_at]) }}</p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <x-button.text
                                                            wire:click.prevent="$set('showLicenseDetails', true)"
                                                            class="!px-0 !py-0"
                                                        >
                                                            {{ __('View license details') }}
                                                        </x-button.text>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="rounded-md bg-red-50 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <x-heroicon-m-x-circle class="h-5 w-5 text-red-400" />
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-red-800">
                                                        {{ __('Unverified') }}
                                                    </h3>
                                                    <div class="mt-2 text-sm text-red-700">
                                                        <p>{{ __('This license code is added without verification or has been revoked.') }}</p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <x-button.text
                                                            wire:click.prevent="$set('showLicenseDetails', true)"
                                                            class="!px-0 !py-0"
                                                        >
                                                            {{ __('View license details') }}
                                                        </x-button.text>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @else
                            {{ __('None yet') }}
                        @endif
                    </div>
                </div>
                <!-- Assignees -->
                <div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Assignees') }}
                        </h2>
                        @if(auth()->user()->is_admin || $this->ticketSettings->allow_agent_to_assign_ticket)
                            <x-dropdown
                                :width="80"
                                :close-on-click="false"
                            >
                                <x-slot:trigger>
                                    <button
                                        type="button"
                                        class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                    >
                                        <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                    </button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                                        {{ __('Assign people to this ticket') }}
                                    </div>
                                    <div class="px-4 py-2 border-b border-slate-200 dark:border-slate-600">
                                        <x-input
                                            wire:model.debounce.500ms="filters.agentName"
                                            type="search"
                                            :placeholder="__('Type or choose an agent')"
                                        />
                                    </div>
                                    <div
                                        wire:target="filters.agentName"
                                        wire:loading.delay.class="opacity-25"
                                        class="relative max-h-64 overflow-y-auto"
                                    >
                                        @forelse($this->agents as $agent)
                                            <x-dropdown-link
                                                wire:click="toggleAssignee('{{ $agent->id }}')"
                                                role="button"
                                                class="relative"
                                            >
                                                <div class="flex items-center">
                                                    <img
                                                        src="{{ $agent->getFirstMediaUrl('avatar') }}"
                                                        alt="{{ __('Avatar') }}"
                                                        class="flex-shrink-0 h-6 w-6 bg-white rounded-full dark:bg-slate-800"
                                                    >
                                                    <span @class(['ml-3 block truncate', 'font-normal' => !in_array($agent->id, $ticket->assignees->pluck('id')->toArray()), 'font-semibold' => in_array($agent->id, $ticket->assignees->pluck('id')->toArray())])>
                                                        {{ $agent->name }}
                                                    </span>
                                                </div>
                                                @if(in_array($agent->id, $ticket->assignees->pluck('id')->toArray()))
                                                    <span class="text-blue-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                                        <x-heroicon-m-check class="w-5 h-5" />
                                                    </span>
                                                @endif
                                            </x-dropdown-link>
                                        @empty
                                            <div class="px-4 py-2 text-sm leading-5 text-slate-700 dark:text-slate-200">
                                                {{ __('No agents found') }}
                                            </div>
                                        @endforelse
                                    </div>
                                </x-slot:content>
                            </x-dropdown>
                        @endif
                    </div>
                    <ul
                        role="list"
                        class="mt-3 space-y-3"
                    >
                        @forelse($ticket->assignees as $agent)
                            <li class="flex justify-start">
                                <a
                                    href="{{ route('agent.agents.details', $agent) }}"
                                    class="flex items-center space-x-3"
                                >
                                    <div class="flex-shrink-0">
                                        <img
                                            src="{{ $agent->getFirstMediaUrl('avatar') }}"
                                            alt="{{ __('Avatar') }}"
                                            class="w-5 h-5 bg-white rounded-full dark:bg-slate-800"
                                        >
                                    </div>
                                    <div class="text-sm font-medium text-slate-900 dark:text-slate-200">
                                        {{ $agent->name }}
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="flex justify-start">
                                <div class="text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('No one -') }}
                                    <button
                                        wire:click="toggleAssignee({{ auth()->user() }})"
                                        class="hover:text-blue-500 dark:hover:text-blue-300"
                                    >
                                        {{ __('assign your self') }}
                                    </button>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <!-- Labels -->
                <div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Labels') }}
                        </h2>
                        <x-dropdown
                            :width="80"
                            :close-on-click="false"
                        >
                            <x-slot:trigger>
                                <button
                                    type="button"
                                    class="p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:text-slate-300 dark:focus:ring-offset-slate-800"
                                >
                                    <x-heroicon-o-cog-8-tooth class="w-5 h-5" />
                                </button>
                            </x-slot:trigger>
                            <x-slot:content>
                                <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                                    {{ __('Apply labels to this ticket') }}
                                </div>
                                <div class="px-4 py-2 border-b border-slate-200 dark:border-slate-600">
                                    <x-input
                                        wire:model.debounce.500ms="filters.labelName"
                                        type="search"
                                        :placeholder="__('Filter labels')"
                                    />
                                </div>
                                <div
                                    wire:target="filters.labelName"
                                    wire:loading.delay.class="opacity-25"
                                    class="relative max-h-64 overflow-y-auto"
                                >
                                    @forelse($this->labels as $label)
                                        <x-dropdown-link
                                            wire:click="toggleLabel('{{ $label->id }}')"
                                            role="button"
                                            class="relative"
                                        >
                                            <div class="flex flex-col">
                                                <div class="flex items-center justify-between">
                                                    <p class="flex items-center">
                                                        <span
                                                            class="flex-shrink-0 inline-block h-2 w-2 rounded-full"
                                                            style="background-color: {{ '#' . $label->color }}"
                                                            aria-hidden="true"
                                                        ></span>
                                                        <span @class(['text-slate-700 ml-1 truncate dark:text-slate-200', 'font-semibold' => in_array($label->id, $ticket->labels->pluck('id')->toArray())])>
                                                            {{ $label->name }}
                                                        </span>
                                                    </p>
                                                    @if(in_array($label->id, $ticket->labels->pluck('id')->toArray()))
                                                        <span class="text-blue-500">
                                                            <x-heroicon-m-check class="h-5 w-5" />
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-slate-500 truncate pr-5 dark:text-slate-400">
                                                    {{ $label->description }}
                                                </p>
                                            </div>
                                        </x-dropdown-link>
                                    @empty
                                        @if($filters['labelName'])
                                            <x-dropdown-link
                                                wire:click="createNewLabel"
                                                role="button"
                                                class="relative"
                                            >
                                                {{ __('Create new label ":name"', ['name' => $filters['labelName']]) }}
                                            </x-dropdown-link>
                                        @else
                                            <div class="px-4 py-2 text-sm leading-5 text-slate-700 dark:text-slate-400">
                                                {{ __('No labels found') }}
                                            </div>
                                        @endif
                                    @endforelse
                                </div>
                            </x-slot:content>
                        </x-dropdown>
                    </div>
                    <ul
                        role="list"
                        class="mt-2 leading-8"
                    >
                        @forelse($ticket->labels as $label)
                            <li class="inline">
                                <a
                                    href="{{ route('agent.tickets.list', ['label' => $label->slug]) }}"
                                    class="relative inline-flex items-center rounded-full border border-slate-300 hover:border-slate-400 px-3 py-0.5 dark:border-slate-600 dark:hover:border-slate-500"
                                    title="{{ $label->description }}"
                                >
                                    <div class="absolute flex-shrink-0 flex items-center justify-center">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full"
                                            style="background-color: {{ '#' . $label->color }}"
                                            aria-hidden="true"
                                        ></span>
                                    </div>
                                    <div class="ml-3.5 text-sm font-medium text-slate-900 dark:text-slate-200">
                                        {{ $label->name }}
                                    </div>
                                </a>
                            </li>
                        @empty
                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                {{ __('None yet') }}
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>
            <!-- Ticket deletion -->
            <div
                x-data="{ confirmingTicketDeletion: false }"
                class="border-t border-slate-200 py-6 dark:border-slate-600"
            >
                <div
                    x-cloak
                    x-show="confirmingTicketDeletion"
                    class="flex items-center justify-between space-x-2"
                >
                    <x-button.secondary
                        x-on:click="confirmingTicketDeletion = false"
                        class="w-full"
                    >
                        {{ __('Cancel') }}
                    </x-button.secondary>
                    <x-button.danger
                        wire:click="deleteTicket"
                        class="w-full"
                    >
                        {{ __('Delete') }}
                    </x-button.danger>
                </div>
                <div x-show="!confirmingTicketDeletion">
                    <x-button.soft-danger
                        x-on:click="confirmingTicketDeletion = true"
                        class="w-full"
                    >
                        {{ __('Delete ticket') }}
                    </x-button.soft-danger>
                </div>
            </div>
        </aside>
    </div>

    <form wire:submit.prevent="saveNewLabel">
        <x-dialog-modal
            wire:model.defer="isCreatingNewLabel"
            max-width="md"
        >
            <x-slot:title>
                {{ __('Create new label') }}
            </x-slot:title>
            <x-slot:content>
                <div class="space-y-5">
                    <div>
                        <x-label :value="__('Preview')" />
                        <div class="mt-1 relative inline-flex items-center rounded-full border border-slate-300 px-3 py-0.5 dark:border-slate-500">
                            <div class="absolute flex-shrink-0 flex items-center justify-center">
                                <span
                                    class="h-1.5 w-1.5 rounded-full"
                                    style="background-color: {{ '#' . $newLabel?->color }}"
                                    aria-hidden="true"
                                ></span>
                            </div>
                            <div class="ml-3.5 text-sm font-medium text-slate-900 dark:text-slate-200">
                                {{ $newLabel?->name ?: __('Label preview') }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <x-label
                            for="newLabel.name"
                            :value="__('Label name')"
                        />
                        <x-input
                            wire:model.debounce.500ms="newLabel.name"
                            type="text"
                            class="mt-1"
                            :placeholder="__('New label name...')"
                        />
                        <x-input-error
                            for="newLabel.name"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="newLabel.description"
                            :value="__('Description')"
                        />
                        <x-input
                            wire:model.defer="newLabel.description"
                            type="text"
                            class="mt-1"
                            :placeholder="__('Optional description')"
                        />
                        <x-input-error
                            for="newLabel.description"
                            class="mt-2"
                        />
                    </div>
                    <div>
                        <x-label
                            for="newLabel.color"
                            :value="__('Color')"
                        />
                        <div class="mt-1 relative flex items-center">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-slate-500 sm:text-sm">#</span>
                            </div>
                            <x-input
                                wire:model.debounce.500ms="newLabel.color"
                                type="text"
                                class="pl-7 pr-12"
                            />
                            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <button
                                    wire:click="generateLabelColor"
                                    type="button"
                                    class="inline-flex items-center border border-slate-200 rounded px-2 text-sm font-sans font-medium text-slate-400 hover:bg-blue-500 hover:border-blue-500 hover:text-white dark:border-slate-500 dark:hover:border-blue-500"
                                >
                                    <x-heroicon-o-arrow-path class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                        <x-input-error
                            for="newLabel.color"
                            class="mt-2"
                        />
                    </div>
                </div>
            </x-slot:content>
            <x-slot:footer>
                <x-button.primary>
                    {{ __('Save') }}
                </x-button.primary>
            </x-slot:footer>
        </x-dialog-modal>
    </form>

    <x-dialog-modal
        wire:model="showLicenseDetails"
        max-width="md"
    >
        <x-slot:title>
            {{ __('License details') }}
        </x-slot:title>
        <x-slot:content>
            <div class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">{{ __('License code') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->is_admin || $this->ticketSettings->allow_agent_to_see_license_code ? $ticket->license_code : '**********' }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">{{ __('License type') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ticket->license_name ?: __('N/a') }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">{{ __('Buyer') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ticket->license_buyer ?: __('N/a') }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">{{ __('Purchase date') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ticket->license_purchased_at ?: __('N/a') }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">{{ __('Support until') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ticket->license_support_ends_at ?: __('N/a') }}</dd>
                </div>
            </div>
        </x-slot:content>
        <x-slot:footer>
            <x-button.secondary wire:click.prevent="$set('showLicenseDetails', false)">
                {{ __('Close') }}
            </x-button.secondary>
        </x-slot:footer>
    </x-dialog-modal>
</div>
