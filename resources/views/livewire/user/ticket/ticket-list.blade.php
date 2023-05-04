<div>
    <x-slot:title>
        {{ __('Tickets') }}
    </x-slot:title>

    <x-slot:header>
        <div class="relative py-6 max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-5xl lg:px-8">
            <h1 class="font-display font-medium tracking-tight text-white text-4xl">
                {{ __('Tickets') }}
            </h1>
        </div>
    </x-slot:header>

    <div class="-mt-32 relative max-w-3xl mx-auto sm:px-6 lg:max-w-5xl lg:px-8">
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="divide-y divide-slate-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                @include('layouts.navigation-user')

                <div class="lg:col-span-9 min-h-[500px]">
                    @if($this->tickets->count())
                        <div class="border-b border-slate-200 pl-4 pr-6 pt-4 pb-4 sm:pl-6 lg:pl-8 xl:pl-6 xl:pt-6">
                            <div class="flex items-center">
                                <h1 class="flex-1 font-display text-lg">
                                    {{ __('Tickets') }}
                                </h1>
                            </div>
                        </div>
                        <ul
                            role="list"
                            class="divide-y divide-slate-200 border-b border-slate-200"
                        >
                            @foreach($this->tickets as $ticket)
                                <li class="relative py-5 pl-4 pr-6 hover:bg-slate-50 sm:py-6 sm:pl-6 lg:pl-8 xl:pl-6">
                                    <div class="min-w-0 space-y-3">
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center rounded bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800 whitespace-nowrap">{{ $ticket->status->label() }}</span>

                                            <h2 class="text-sm font-medium truncate">
                                                <a href="{{ route('user.tickets.details', $ticket) }}">
                                                    <span class="absolute inset-0"></span>
                                                    {{ $ticket->subject }}
                                                </a>
                                            </h2>
                                        </div>
                                        <div class="mt-2 flex items-center justify-between space-x-4">
                                            <!-- Product -->
                                            <div class="min-w-0 space-y-3">
                                                <p class="flex items-center space-x-2.5">
                                                    <span class="truncate text-sm font-medium text-slate-500">{{ $ticket->product->name }}</span>
                                                </p>
                                            </div>
                                            <!-- Meta info -->
                                            <div class="hidden flex-shrink-0 flex-col items-end space-y-3 sm:flex">
                                                <p class="flex space-x-2 text-sm text-slate-500">
                                                    <span>{{ __('Last activity :timeago', ['timeago' => $ticket->updated_at->diffForHumans()]) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if($this->tickets->hasPages())
                            <div class="p-4 sm:px-6 lg:px-8 xl:px-6">
                                {{ $this->tickets->links() }}
                            </div>
                        @endif
                    @else
                        <div class="h-full py-10 text-center">
                            <x-heroicon-o-inbox class="mx-auto h-12 w-12 text-slate-400" />
                            <h3 class="mt-2 text-sm font-medium text-slate-900">{{ __('No tickets') }}</h3>
                            <p class="mt-1 text-sm text-slate-500">{{ __('Get started by submitting a new ticket.') }}</p>
                            <div class="mt-6">
                                <a
                                    href="{{ route('user.tickets.create') }}"
                                    class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    <x-heroicon-m-plus class="-ml-1 mr-2 h-5 w-5" />
                                    {{ __('Submit a ticket') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
