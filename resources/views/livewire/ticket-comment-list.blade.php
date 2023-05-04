<div
    x-data="{ showFilterForm: false }"
    x-on:toggle-filter.window="showFilterForm = !showFilterForm"
>
    <form
        x-show="showFilterForm"
        x-trap.noreturn="showFilterForm"
        wire:submit.prevent="applyFilters"
        class="mb-6 bg-slate-100 p-4 rounded-lg"
    >
        <div class="space-y-6 sm:space-y-5">
            <div>
                <x-label
                    for="search"
                    :value="__('Search')"
                    class="sr-only"
                />
                <x-input
                    id="search"
                    type="text"
                    class="block mt-1 w-full"
                    wire:model.defer="search"
                    placeholder="{{ __('Search by comment body') }}"
                />
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <x-label
                    for="visibility"
                    :value="__('Comment visibility')"
                />
                <div class="mt-1 sm:col-span-2 sm:mt-0 flex items-center sm:justify-end space-x-10">
                    <div class="flex items-center">
                        <x-checkbox
                            wire:model.defer="commentVisibility"
                            id="show-all"
                            name="comment-visibility"
                            type="radio"
                            value="all"
                            class="!rounded-full"
                        />
                        <x-label
                            for="show-all"
                            :value="__('All')"
                            class="ml-3"
                        />
                    </div>

                    <div class="flex items-center">
                        <x-checkbox
                            wire:model.defer="commentVisibility"
                            id="show-public"
                            name="comment-visibility"
                            type="radio"
                            value="public"
                            class="!rounded-full"
                        />
                        <x-label
                            for="show-public"
                            :value="__('Public')"
                            class="ml-3"
                        />
                    </div>

                    <div class="flex items-center">
                        <x-checkbox
                            wire:model.defer="commentVisibility"
                            id="show-private"
                            name="comment-visibility"
                            type="radio"
                            value="private"
                            class="!rounded-full"
                        />
                        <x-label
                            for="show-private"
                            :value="__('Private')"
                            class="ml-3"
                        />
                    </div>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <x-label
                    for="perPage"
                    :value="__('Results per page')"
                    class="sm:mt-px sm:pt-2"
                />
                <div class="mt-1 sm:flex sm:justify-end sm:col-span-2 sm:mt-0">
                    <x-select
                        id="perPage"
                        class="block sm:!w-24"
                        wire:model.defer="perPage"
                    >
                        @foreach($this->perPageOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <x-label
                    for="sortDirection"
                    :value="__('Sort results by')"
                    class="sm:mt-px sm:pt-2"
                />
                <div class="mt-1 sm:flex sm:justify-end sm:col-span-2 sm:mt-0">
                    <x-select
                        id="sortDirection"
                        class="block sm:!w-auto"
                        wire:model.defer="sortDirection"
                    >
                        <option value="desc">{{ __('Newest first') }}</option>
                        <option value="asc">{{ __('Oldest first') }}</option>
                    </x-select>
                </div>
            </div>

            <div class="flex justify-end sm:border-t sm:border-gray-200 sm:pt-5">
                <x-button.text
                    wire:click="resetFilters"
                    wire:loading.attr="disabled"
                    wire:target="resetFilters"
                    type="button"
                >
                    {{ __('Reset filters') }}
                </x-button.text>
                <x-button.primary
                    wire:loading.attr="disabled"
                    wire:target="resetFilters"
                    class="ml-3"
                >
                    {{ __('Apply filters') }}
                </x-button.primary>
            </div>
        </div>
    </form>
    @if($this->comments->count())
        @if($sortDirection === 'desc')
            <!-- Comment form-->
            <div
                x-data="{ showCommentForm: false }"
                x-show="showCommentForm"
                x-transition
                x-on:show-comment-form.window="showCommentForm = true"
                x-on:hide-comment-form.window="showCommentForm = false"
                x-on:comment-submitted.window="showCommentForm = false"
                wire:key="comment-form-top"
                class="mb-8"
            >
                <div class="flex sm:space-x-3">
                    <div class="hidden sm:block flex-shrink-0">
                        <div class="relative">
                            <img
                                src="{{ auth()->user()->getFirstMediaUrl('avatar') }}"
                                alt="{{ __('Avatar') }}"
                                class="w-10 h-10 rounded-full bg-white ring-8 ring-white dark:bg-slate-800 dark:ring-slate-800"
                            >
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        @if(auth()->user() instanceof \App\Models\User && $ticket->status->value === \App\Enums\TicketStatus::CLOSED->value)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <x-heroicon-m-exclamation-triangle class="h-5 w-5 text-yellow-400" />
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">
                                            {{ __('This ticket is closed') }}
                                        </h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>
                                                {{ __('You can not comment on a closed ticket.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif(auth()->user() instanceof \App\Models\User && $ticket->has_valid_license && !$ticket->has_active_support)
                            <div class="bg-red-50 border border-red-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <x-heroicon-m-x-circle class="h-5 w-5 text-red-400" />
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">
                                            {{ __('Support expired') }}
                                        </h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>
                                                {{ __('Your license support period has ended, please renew your license to continue.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <livewire:ticket-comment-form :ticket="$ticket" />
                        @endif
                    </div>
                </div>
            </div>
        @else
            @if($this->comments->hasPages())
                <div class="-mt-6 mb-8 py-4 border-b border-slate-200 dark:border-slate-600">
                    {{ $this->comments->onEachSide(1)->links() }}
                </div>
            @endif
        @endif

        <div
            wire:loading.delay.class.remove="hidden"
            class="hidden"
        >
            <div class="animate-pulse flex space-x-3">
                <div class="rounded-full bg-slate-500 h-10 w-10"></div>
                <div class="flex-1 space-y-6 py-1">
                    <div class="h-2 bg-slate-500 rounded"></div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="h-2 bg-slate-500 rounded col-span-2"></div>
                            <div class="h-2 bg-slate-500 rounded col-span-1"></div>
                        </div>
                        <div class="h-2 bg-slate-500 rounded"></div>
                    </div>
                </div>
            </div>
        </div>

        <ul wire:loading.delay.class="hidden">
            @foreach($this->comments as $comment)
                <li>
                    <div @class(['relative', 'pb-8' => !$loop->last])>
                        @unless($loop->last)
                            <span
                                class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-slate-200 dark:bg-slate-600"
                                aria-hidden="true"
                            ></span>
                        @endif

                        <div class="relative flex items-start space-x-3">
                            <div class="relative">
                                <img
                                    src="{{ $comment->commentator->getFirstMediaUrl('avatar') }}"
                                    alt="{{ __('Avatar') }}"
                                    @class(['w-10 h-10 rounded-full ring-8 ring-white dark:ring-slate-800', 'bg-white dark:bg-slate-800' => $comment->commentator instanceof \App\Models\Agent, 'bg-slate-200' => $comment->commentator instanceof \App\Models\User])
                                >
                            </div>
                            <div class="min-w-0 flex-1">
                                <div>
                                    <div class="text-sm">
                                        <a
                                            href="{{ $comment->commentator instanceof \App\Models\User ? route('agent.users.details', $comment->commentator) : route('agent.agents.details', $comment->commentator) }}"
                                            class="font-medium text-slate-900 dark:text-slate-200"
                                        >
                                            {{ $comment->commentator->name }}
                                        </a>
                                    </div>
                                    <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                                        {{ $comment->created_at->diffForHumans() }}
                                        @if($comment->is_private)
                                            <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                                {{ __('Private') }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="mt-2 max-w-none prose prose-slate break-words prose-a:text-blue-600 hover:prose-a:text-blue-500 sm:prose-sm dark:prose-invert dark:prose-a:text-blue-400 dark:hover:prose-a:text-blue-300">
                                    <p>{!! $comment->content !!}</p>
                                </div>
                                @if($comment->hasMedia('attachments'))
                                    <div class="mt-2">
                                        <livewire:attachment-list
                                            :model="$comment"
                                            :wire:key="'comment-'.$comment->id"
                                        />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        @if($sortDirection === 'asc')
            <!-- Comment form-->
            <div
                x-data="{ showCommentForm: false }"
                x-show="showCommentForm"
                x-transition
                x-on:show-comment-form.window="showCommentForm = true"
                x-on:hide-comment-form.window="showCommentForm = false"
                x-on:comment-submitted.window="showCommentForm = false"
                wire:key="comment-form-bottom"
                class="mt-8"
            >
                <div class="flex sm:space-x-3">
                    <div class="hidden sm:block flex-shrink-0">
                        <div class="relative">
                            <img
                                src="{{ auth()->user()->getFirstMediaUrl('avatar') }}"
                                alt="{{ __('Avatar') }}"
                                class="w-10 h-10 rounded-full bg-white ring-8 ring-white dark:bg-slate-800 dark:ring-slate-800"
                            >
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        @if(auth()->user() instanceof \App\Models\User && $ticket->status->value === \App\Enums\TicketStatus::CLOSED->value)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <x-heroicon-m-exclamation-triangle class="h-5 w-5 text-yellow-400" />
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">
                                            {{ __('This ticket is closed') }}
                                        </h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>
                                                {{ __('You can not comment on a closed ticket.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif(auth()->user() instanceof \App\Models\User && $ticket->has_valid_license && !$ticket->has_active_support)
                            <div class="bg-red-50 border border-red-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <x-heroicon-m-x-circle class="h-5 w-5 text-red-400" />
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">
                                            {{ __('Support expired') }}
                                        </h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>
                                                {{ __('Your license support period has ended, please renew your license to continue.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <livewire:ticket-comment-form :ticket="$ticket" />
                        @endif
                    </div>
                </div>
            </div>
        @else
            @if($this->comments->hasPages())
                <div class="mt-8 py-4 border-y border-slate-200 dark:border-slate-600">
                    {{ $this->comments->onEachSide(1)->links() }}
                </div>
            @endif
        @endif
    @else
        <div class="text-center">
            <x-heroicon-o-chat-bubble-left-right class="mx-auto h-12 w-12 text-slate-400" />
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-slate-200">{{ __('No comments') }}</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Get started by submitting a new comment.') }}</p>
        </div>

        <!-- Comment form-->
        <div
            wire:key="comment-form-empty"
            class="my-8"
        >
            <div class="flex sm:space-x-3">
                <div class="hidden sm:block flex-shrink-0">
                    <div class="relative">
                        <img
                            src="{{ auth()->user()->getFirstMediaUrl('avatar') }}"
                            alt="{{ __('Avatar') }}"
                            class="w-10 h-10 rounded-full bg-white ring-8 ring-white dark:bg-slate-800 dark:ring-slate-800"
                        >
                    </div>
                </div>
                <div class="min-w-0 flex-1">
                    <livewire:ticket-comment-form :ticket="$ticket" />
                </div>
            </div>
        </div>
    @endif
</div>
