<div>
    <div class="ml-3 relative">
        <x-dropdown width="80">
            <x-slot:trigger>
                <button
                    type="button"
                    class="relative bg-white p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-slate-300 dark:hover:text-slate-200 dark:focus:ring-offset-slate-800"
                >
                    <span class="sr-only">{{ __('Open notification page') }}</span>
                    <x-heroicon-o-inbox-stack class="w-6 h-6" />
                    @if($this->openTicketsCount > 0)
                        <span class="absolute block top-0.5 right-0 h-2.5 w-2.5 rounded-full bg-blue-400 ring-2 ring-white dark:ring-slate-800"></span>
                    @endif
                </button>
            </x-slot:trigger>
            <x-slot:content>
                <div class="px-4 py-2 border-b border-slate-200 font-medium text-xs text-slate-700 dark:border-slate-600 dark:text-slate-200">
                    {{ __('Ticket waiting for your response') }}
                </div>
                <div
                    x-init="$watch('open', function(value) {
                        if (value) {
                            $wire.loadOpenTickets();
                        }
                    })"
                    class="max-h-96 overflow-y-auto"
                >
                    <div
                        wire:target="loadOpenTickets"
                        wire:loading.block
                        class="p-4"
                    >
                        <div class="animate-pulse flex space-x-4">
                            <div class="flex-1 space-y-6 py-1">
                                <div class="space-y-3">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                                        <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                                    </div>
                                    <div class="h-2 bg-slate-700 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        wire:target="loadOpenTickets"
                        wire:loading.remove
                        class="divide-y divide-slate-200 dark:divide-slate-600"
                    >
                        @forelse($openTicketRows as $ticket)
                            <x-dropdown-link href="{{ route('agent.tickets.details', $ticket->id) }}">
                                <p class="flex items-center font-medium text-slate-900 dark:text-slate-200">
                                    <x-icon
                                        name="{{ $ticket->priority->icon() }}"
                                        class="-ml-1 flex-shrink-0 h-4 w-4"
                                        style="color: {{ $ticket->priority->color() }}"
                                    />
                                    <span class="truncate">{{ $ticket->subject }}</span>
                                </p>
                                <p class="ml-3 text-slate-500 dark:text-slate-400">
                                    {{ __('Last activity: :time', ['time' => $ticket->created_at->diffForHumans()]) }}
                                </p>
                            </x-dropdown-link>
                        @empty
                            <div class="px-4 py-3">
                                <p class="text-slate-900 text-sm dark:text-slate-200">
                                    {{ __('Nope, you have no open tickets.') }}
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </x-slot:content>
        </x-dropdown>
    </div>
</div>
