<div>
    <x-slot:title>
        {{ __('Ticket #:id', ['id' => $ticket->id]) }}
    </x-slot:title>

    <x-slot:header>
        <div class="relative py-6 max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-5xl lg:px-8">
            <h1 class="font-display font-medium tracking-tight text-white text-4xl">
                {{ __('Ticket #:id', ['id' => $ticket->id]) }}
            </h1>
        </div>
    </x-slot:header>

    <div class="-mt-32 relative max-w-3xl mx-auto sm:px-6 lg:max-w-5xl lg:px-8">
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="divide-y divide-slate-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                @include('layouts.navigation-user')

                <div class="lg:col-span-9 min-h-[500px]">
                    <div class="border-b border-slate-200 pl-4 pr-6 pt-4 pb-4 sm:pl-6 lg:pl-8 xl:pl-6 xl:pt-6">
                        <div class="flex items-baseline justify-between">
                            <h1 class="flex-1 font-display text-lg">
                                {{ $ticket->subject }}
                            </h1>
                            <span class="ml-5 hidden sm:inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-sm font-medium text-blue-800">
                                {{ $ticket->status->label() }}
                            </span>
                        </div>
                        <div>
                            <span class="text-sm text-slate-500">
                                {{ __('Submitted :timeago on :date', ['timeago' => $ticket->created_at->diffForHumans(), 'date' => $ticket->created_at->toFormattedDateString()]) }}
                            </span>
                        </div>
                    </div>
                    <div class="px-4 py-6 sm:p-6">
                        <!-- Ticket content-->
                        <div class="prose prose-slate prose-a:text-blue-600 hover:prose-a:text-blue-500 max-w-none break-words">
                            {!! $ticket->content !!}
                        </div>
                        <!-- Ticket attachment-->
                        @if($ticket->hasMedia('attachments'))
                            <div class="py-3 xl:pt-6 xl:pb-0">
                                <livewire:attachment-list :model="$ticket" />
                            </div>
                        @endif
                        <!-- Conversation -->
                        <section
                            aria-labelledby="activity-title"
                            class="mt-8 xl:mt-10"
                        >
                            <div>
                                <div class="divide-y divide-slate-200">
                                    <div
                                        x-data
                                        class="flex items-center justify-between pb-4"
                                    >
                                        <h2
                                            id="activity-title"
                                            class="text-lg font-medium text-slate-900"
                                        >
                                            {{ __('Conversation') }}
                                        </h2>
                                        <x-button.primary
                                            x-on:click="$dispatch('show-comment-form')"
                                            type="button"
                                        >
                                            <x-heroicon-m-arrow-uturn-left class="-ml-1 mr-2 w-5 h-5 text-white" />
                                            {{ __('Reply') }}
                                        </x-button.primary>
                                    </div>
                                    <div class="pt-6">
                                        <!-- Conversation feed-->
                                        <div class="flow-root">
                                            <livewire:ticket-comment-list :ticket="$ticket" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
