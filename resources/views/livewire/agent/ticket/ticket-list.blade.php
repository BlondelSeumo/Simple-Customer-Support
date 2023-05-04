<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Tickets') }}
        </h1>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-4">
            <x-card class="-mx-4 sm:-mx-0">
                <x-slot:header>
                    <div>
                        <div class="sm:hidden">
                            <label
                                for="ticket-status"
                                class="sr-only"
                            >
                                {{ __('Filter by status') }}
                            </label>
                            <x-select
                                wire:model="status"
                                id="ticket-status"
                                name="ticket-status"
                                class="block w-full focus:ring-blue-500 focus:border-blue-500 border-slate-300 rounded-md dark:border-slate-600"
                            >
                                <option value="">
                                    {{ __('All') }}
                                </option>
                                @foreach(\App\Enums\TicketStatus::cases() as $ticketStatus)
                                    <option value="{{ $ticketStatus->value }}">
                                        {{ $ticketStatus->label() }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="hidden sm:block">
                            <div class="-mx-4 sm:-mx-6 border-b border-slate-200 dark:border-slate-600">
                                <nav
                                    class="-mb-px flex space-x-8 px-4 sm:px-6"
                                    aria-label="Tabs"
                                >
                                    <button
                                        wire:click="$set('status', null)"
                                        type="button"
                                        @class(['whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 dark:hover:border-slate-300' => $status, 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => !$status])
                                    >
                                        {{ __('All') }}
                                    </button>
                                    @foreach(\App\Enums\TicketStatus::cases() as $ticketStatus)
                                        <button
                                            wire:click="$set('status', '{{ $ticketStatus->value }}')"
                                            type="button"
                                            @class(['whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 dark:hover:border-slate-300' => $status !== $ticketStatus->value, 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200' => $status === $ticketStatus->value])
                                        >
                                            {{ $ticketStatus->label() }}
                                        </button>
                                    @endforeach
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <x-input
                            wire:model.debounce.500ms="search"
                            type="search"
                            placeholder="{{ __('Search') }}"
                        />
                    </div>
                    @if($label || $author || $assignee || $priority || $product || $category )
                        <div class="mt-3 inline-flex space-x-2">
                            @if($this->label)
                                <div>
                                    <span class="inline-flex items-center py-1 pl-2 pr-1 rounded text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ __('Label') }}: {{ \App\Models\Label::whereSlug($this->label)->first()->name }}
                                        <button
                                            wire:click="$set('label', null)"
                                            type="button"
                                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-blue-400 hover:bg-blue-200 hover:text-blue-500 focus:outline-none focus:bg-blue-500 focus:text-white"
                                        >
                                            <span class="sr-only">{{ __('Remove') }}</span>
                                            <x-heroicon-s-x-mark class="h-3 w-3" />
                                        </button>
                                    </span>
                                </div>
                            @endif
                            @if($this->author)
                                <div>
                                    <span class="inline-flex items-center py-1 pl-2 pr-1 rounded text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ __('Author') }}: {{ \App\Models\User::find($author)->name }}
                                        <button
                                            wire:click="$set('author', null)"
                                            type="button"
                                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-blue-400 hover:bg-blue-200 hover:text-blue-500 focus:outline-none focus:bg-blue-500 focus:text-white"
                                        >
                                            <span class="sr-only">{{ __('Remove') }}</span>
                                            <x-heroicon-s-x-mark class="h-3 w-3" />
                                        </button>
                                    </span>
                                </div>
                            @endif
                            @if($this->assignee)
                                <div>
                                    <span class="inline-flex items-center py-1 pl-2 pr-1 rounded text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ __('Assignee') }}: {{ \App\Models\Agent::find($assignee)->name }}
                                        <button
                                            wire:click="$set('assignee', null)"
                                            type="button"
                                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-blue-400 hover:bg-blue-200 hover:text-blue-500 focus:outline-none focus:bg-blue-500 focus:text-white"
                                        >
                                            <span class="sr-only">{{ __('Remove') }}</span>
                                            <x-heroicon-s-x-mark class="h-3 w-3" />
                                        </button>
                                    </span>
                                </div>
                            @endif
                            @if($this->priority)
                                <div>
                                    <span class="inline-flex items-center py-1 pl-2 pr-1 rounded text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ __('Priority') }}: {{ \App\Enums\TicketPriority::tryFrom($this->priority)->label() }}
                                        <button
                                            wire:click="$set('priority', null)"
                                            type="button"
                                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-blue-400 hover:bg-blue-200 hover:text-blue-500 focus:outline-none focus:bg-blue-500 focus:text-white"
                                        >
                                            <span class="sr-only">{{ __('Remove') }}</span>
                                            <x-heroicon-s-x-mark class="h-3 w-3" />
                                        </button>
                                    </span>
                                </div>
                            @endif
                            @if($this->product)
                                <div>
                                    <span class="inline-flex items-center py-1 pl-2 pr-1 rounded text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ __('Product') }}: {{ \App\Models\Product::find($product)->name }}
                                        <button
                                            wire:click="$set('product', null)"
                                            type="button"
                                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-blue-400 hover:bg-blue-200 hover:text-blue-500 focus:outline-none focus:bg-blue-500 focus:text-white"
                                        >
                                            <span class="sr-only">{{ __('Remove') }}</span>
                                            <x-heroicon-s-x-mark class="h-3 w-3" />
                                        </button>
                                    </span>
                                </div>
                            @endif
                            @if($this->category)
                                <div>
                                    <span class="inline-flex items-center py-1 pl-2 pr-1 rounded text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ __('Category') }}: {{ \App\Models\Category::whereSlug($this->category)->first()->name }}
                                        <button
                                            wire:click="$set('category', null)"
                                            type="button"
                                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-blue-400 hover:bg-blue-200 hover:text-blue-500 focus:outline-none focus:bg-blue-500 focus:text-white"
                                        >
                                            <span class="sr-only">{{ __('Remove') }}</span>
                                            <x-heroicon-s-x-mark class="h-3 w-3" />
                                        </button>
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endif
                </x-slot:header>
                <x-slot:content>
                    <div class="-mx-4 -my-6 overflow-x-auto sm:-mx-6">
                        <div class="inline-block min-w-full align-middle">
                            <div class="relative overflow-hidden ring-1 ring-black ring-opacity-5">
                                <div
                                    wire:loading.delay
                                    class="absolute inset-0 z-10 bg-slate-100/50 dark:bg-slate-700/50"
                                >
                                    <div
                                        wire:loading.flex
                                        class="h-full w-full items-center justify-center"
                                    >
                                        <div class="m-auto flex items-center space-x-2">
                                            <x-loading-spinner class="w-5 h-5 dark:text-slate-200" />
                                            <p class="text-sm dark:text-slate-200">{{ 'Loading tickets...' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <table class="min-w-full divide-y divide-slate-300 dark:divide-slate-600">
                                    <thead class="bg-slate-50 dark:bg-slate-700">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="pl-4 pr-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap sm:pl-6 dark:text-slate-200"
                                            >
                                                {{ __('Subject') }}
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap dark:text-slate-200"
                                            >
                                                {{ __('Assignee') }}
                                            </th>
                                            <th
                                                wire:click="sortBy('updated_at')"
                                                scope="col"
                                                class="pl-3 pr-4 py-3 text-right text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap cursor-pointer sm:pr-6 dark:text-slate-200"
                                            >
                                                {{ __('Last activity') }}
                                                @if(array_key_exists('updated_at', $sorts))
                                                    @if($sorts['updated_at'] === 'asc')
                                                        <x-heroicon-m-chevron-up class="inline-block w-4 h-4" />
                                                    @else
                                                        <x-heroicon-m-chevron-down class="inline-block w-4 h-4" />
                                                    @endif
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-600">
                                        @forelse($tickets as $ticket)
                                            <tr
                                                wire:loading.class.delay="opacity-50"
                                                class="relative hover:bg-slate-50 dark:hover:bg-slate-700/25"
                                            >
                                                <td class="pl-4 pr-3 py-4 font-medium text-sm text-slate-900 whitespace-nowrap sm:pl-6 dark:text-slate-200">
                                                    <a
                                                        href="{{ route('agent.tickets.details', $ticket) }}"
                                                        class="inline-flex items-center truncate hover:text-blue-500 hover:underline dark:hover:text-blue-400"
                                                    >
                                                        <x-icon
                                                            name="{{ $ticket->priority->icon() }}"
                                                            class="relative h-4 w-4"
                                                            style="color: {{ $ticket->priority->color() }}"
                                                            data-tippy-content="{{ trans('Priority: :level', ['level' => $ticket->priority->label()]) }}"
                                                            data-tippy-placement="right"
                                                        />
                                                        <span>{{ $ticket->subject }}</span>
                                                    </a>
                                                    <p class="ml-4 font-normal text-slate-500 dark:text-slate-400">
                                                        {{ __('#:id opened :time', ['id' => $ticket->id, 'time' => $ticket->created_at->diffForHumans()]) }}
                                                        {{ __('by') }}
                                                        <a
                                                            wire:click="$set('author', '{{ $ticket->user->id }}')"
                                                            role="button"
                                                            class="relative font-normal text-slate-500 hover:text-blue-500 dark:text-slate-400 dark:hover:text-blue-400"
                                                        >
                                                            {{ $ticket->user->name }}
                                                        </a>
                                                        <span>{{ __('in') }}</span>
                                                        <a
                                                            wire:click="$set('category', '{{ $ticket->category->slug }}')"
                                                            role="button"
                                                            class="relative font-normal text-slate-500 hover:text-blue-500 dark:text-slate-400 dark:hover:text-blue-400"
                                                        >
                                                            {{ $ticket->category->name }}
                                                        </a>
                                                    </p>
                                                </td>
                                                <td class="relative px-3 py-4 text-sm text-slate-500 whitespace-nowrap dark:text-slate-400">
                                                    <div class="flex items-center space-x-2">
                                                        @if($ticket->assignees->count())
                                                            <div class="flex flex-shrink-0 -space-x-1">
                                                                @foreach($ticket->assignees->take(4) as $assignee)
                                                                    <a
                                                                        wire:click="$set('assignee', '{{ $assignee->id }}')"
                                                                        role="button"
                                                                        class="rounded-full ring-2 ring-white hover:ring-blue-500 hover:-translate-y-0.5 transition dark:ring-slate-300"
                                                                        data-tippy-content="{{ $assignee->name }}"
                                                                    >
                                                                        <img
                                                                            class="bg-white max-w-none h-6 w-6 p-0.5 rounded-full dark:bg-slate-800"
                                                                            src="{{ $assignee->getFirstMediaUrl('avatar') }}"
                                                                            alt="{{ $assignee->name }}"
                                                                        >
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            {{ __('No one') }}
                                                        @endif
                                                        @if($ticket->assignees->count() > 4)
                                                            <span class="flex-shrink-0 text-xs leading-5 font-medium">
                                                                +{{ $ticket->assignees->count() - 4 }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="pl-3 pr-4 py-4 text-right text-sm text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-400">
                                                    {{ $ticket->updated_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr wire:loading.class.delay="opacity-50">
                                                <td
                                                    colspan="4"
                                                    class="px-3 py-8 text-center text-slate-500 dark:text-slate-400"
                                                >
                                                    <div class="inline-flex items-center space-x-1">
                                                        <x-heroicon-o-inbox class="w-5 h-5 text-slate-400" />
                                                        <span>{{ __('No records found...') }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </x-slot:content>
                @if($tickets->hasPages())
                    <x-slot:footer>
                        {{ $tickets->links() }}
                    </x-slot:footer>
                @endif
            </x-card>
        </div>
    </div>
</div>
