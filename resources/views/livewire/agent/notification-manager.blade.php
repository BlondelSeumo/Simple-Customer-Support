<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Notifications') }}
        </h1>
        <div class="mt-4 sm:mt-0">
            <span class="isolate inline-flex rounded-md shadow-sm">
                <button
                    wire:click="$set('isUnRead', false)"
                    type="button"
                    @class(['relative inline-flex items-center rounded-l-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500', 'bg-white hover:bg-slate-50 dark:bg-slate-700 dark:border-slate-500 dark:text-slate-200 dark:focus:ring-blue-400 dark:focus:border-blue-400 dark:hover:border-slate-400 dark:focus:ring-offset-slate-800' => $isUnRead, 'bg-slate-100' => !$isUnRead])
                >
                    {{ __('All') }}
                </button>
                <button
                    wire:click="$set('isUnRead', true)"
                    type="button"
                    @class(['relative -ml-px inline-flex items-center rounded-r-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500', 'bg-white hover:bg-slate-50 dark:bg-slate-700 dark:border-slate-500 dark:text-slate-200 dark:focus:ring-blue-400 dark:focus:border-blue-400 dark:hover:border-slate-400 dark:focus:ring-offset-slate-800' => !$isUnRead, 'bg-slate-100' => $isUnRead])
                >
                    {{ __('Unread') }}
                </button>
            </span>
        </div>
    </div>

    <div class="mt-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-card class="relative rounded-lg overflow-hidden">
            <x-slot:content>
                <div class="-mx-4 -my-6 overflow-x-auto sm:-mx-6">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ring-1 ring-black ring-opacity-5">
                            <table class="min-w-full table-fixed divide-y divide-slate-300 dark:divide-slate-600">
                                <thead class="bg-slate-50 dark:bg-slate-700/50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="relative w-8 px-6 sm:px-8 dark:text-slate-200"
                                        >
                                            <x-checkbox
                                                wire:model="selectPage"
                                                class="absolute left-4 top-1/2 -mt-2 sm:left-6"
                                            />
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative pr-3 py-4 text-left text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap dark:text-slate-200"
                                        >
                                            <div class="flex items-center space-x-2">
                                                @if(!$selected)
                                                    {{ __('Message') }}
                                                @else
                                                    <span>{{ trans(':count selected', ['count' => count($selected)]) }}</span>
                                                    <button
                                                        wire:click="markSelectedNotificationAsRead"
                                                        type="button"
                                                        class="inline-flex items-center rounded border border-slate-300 bg-white px-2.5 py-1.5 -my-2 text-xs font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none"
                                                    >
                                                        {{ __('Mark as read') }}
                                                    </button>
                                                    <button
                                                        wire:click="markSelectedNotificationAsUnRead"
                                                        type="button"
                                                        class="inline-flex items-center rounded border border-slate-300 bg-white px-2.5 py-1.5 -my-2 text-xs font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none"
                                                    >
                                                        {{ __('Mark as unread') }}
                                                    </button>
                                                    <button
                                                        wire:click="deleteSelectedNotification"
                                                        type="button"
                                                        class="inline-flex items-center rounded border border-slate-300 bg-white px-2.5 py-1.5 -my-2 text-xs font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none"
                                                    >
                                                        {{ __('Delete selected') }}
                                                    </button>
                                                    @if($notifications->total() > $notifications->count())
                                                        <button
                                                            wire:click="$toggle('selectAll')"
                                                            class="text-blue-600 hover:text-blue-500"
                                                        >
                                                            {{ $selectAll ? __('Clear selection') : __('Select all :count notifications', ['count' => $notifications->total()]) }}
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative pl-3 pr-4 py-4 text-right text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-200"
                                        >
                                            <span class="sr-only">{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 bg-white dark:bg-slate-800 dark:divide-slate-600">
                                    @forelse($notifications as $notification)
                                        <tr
                                            wire:loading.class.delay="opacity-50"
                                            @class(['group hover:bg-slate-50 dark:hover:bg-slate-700/25', 'bg-slate-50 dark:bg-slate-700/25' => $notification->read_at])
                                        >
                                            <td class="relative w-8 px-6 sm:px-8">
                                                @if(in_array($notification->id, $selected))
                                                    <div class="absolute inset-y-0 left-0 w-0.5 bg-blue-500 dark:bg-blue-400"></div>
                                                @endif
                                                <x-checkbox
                                                    wire:model="selected"
                                                    wire:key="checkbox-{{ $notification->id }}"
                                                    value="{{ $notification->id }}"
                                                    class="absolute left-4 top-1/2 -mt-2 sm:left-6"
                                                />
                                            </td>
                                            <td class="whitespace-nowrap pr-3 py-4 text-sm text-slate-900">
                                                <div class="flex flex-shrink-0 items-center text-slate-500 dark:text-slate-400">
                                                    @if($notification->data['type'] === 'comment')
                                                        <x-heroicon-o-chat-bubble-left class="inline-block w-5 h-5" />
                                                    @else
                                                        <x-heroicon-o-ticket class="inline-block w-5 h-5" />
                                                    @endif
                                                    <span class="ml-2">{{ trans('Ticket #:id', ['id' => $notification->data['id']]) }}</span>
                                                </div>
                                                <div class="font-medium text-slate-900 dark:text-slate-200">
                                                    <a href="{{ route('agent.tickets.details', $notification->data['id']) }}">
                                                        {{ $notification->data['message'] }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="relative whitespace-nowrap pl-3 pr-4 py-4 text-right text-sm text-slate-500 sm:pr-6 dark:text-slate-400">
                                                <div class="hidden items-center justify-end space-x-2 group-hover:flex">
                                                    @if($notification->read_at)
                                                        <button
                                                            wire:click="markNotificationAsUnRead('{{ $notification->id }}')"
                                                            type="button"
                                                            title="{{ __('Mark as read') }}"
                                                            class="p-1 rounded-md relative hover:bg-slate-200 hover:text-blue-500 dark:hover:bg-slate-600"
                                                        >
                                                            <x-heroicon-m-eye-slash class="h-4 w-4" />
                                                            <span class="sr-only">{{ __('Mark as read') }}</span>
                                                        </button>
                                                    @else
                                                        <button
                                                            wire:click="markNotificationAsRead('{{ $notification->id }}')"
                                                            type="button"
                                                            title="{{ __('Mark as read') }}"
                                                            class="p-1 rounded-md relative hover:bg-slate-200 hover:text-blue-500 dark:hover:bg-slate-600"
                                                        >
                                                            <x-heroicon-m-eye class="h-4 w-4" />
                                                            <span class="sr-only">{{ __('Mark as read') }}</span>
                                                        </button>
                                                    @endif
                                                    <button
                                                        wire:click="deleteNotification('{{ $notification->id }}')"
                                                        type="button"
                                                        title="{{ __('Delete notification') }}"
                                                        class="p-1 rounded-md relative hover:bg-slate-200 hover:text-red-500 dark:hover:bg-slate-600"
                                                    >
                                                        <x-heroicon-m-trash class="h-4 w-4" />
                                                        <span class="sr-only">{{ __('Delete notification') }}</span>
                                                    </button>
                                                </div>
                                                <span class="flex justify-end group-hover:hidden">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr wire:loading.class.delay="opacity-50">
                                            <td
                                                colspan="4"
                                                class="px-3 py-8 text-center text-slate-500"
                                            >
                                                <div class="inline-flex items-center space-x-1">
                                                    <x-heroicon-o-inbox class="w-5 h-5 text-slate-400" />
                                                    <span>{{ __('You have no new notifications.') }}</span>
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
            @if($notifications->hasPages())
                <x-slot:footer>
                    {{ $notifications->links() }}
                </x-slot:footer>
            @endif
        </x-card>
    </div>
</div>
