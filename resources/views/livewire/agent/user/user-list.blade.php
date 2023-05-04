<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Users') }}
        </h1>
        <div class="mt-4 sm:mt-0">
            <a
                href="{{ route('agent.users.create') }}"
                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-slate-800"
            >
                <x-heroicon-m-user-plus class="-ml-1 mr-2 w-4 h-4" />
                {{ __('Add new User') }}
            </a>
        </div>
    </div>

    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-card class="-mx-4 sm:-mx-0 overflow-hidden">
            <x-slot:header>
                <div>
                    <x-input
                        wire:model.debounce.500ms="search"
                        type="search"
                        placeholder="{{ __('Search for user by name or email...') }}"
                    />
                </div>
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
                                        <p class="text-sm dark:text-slate-200">{{ 'Loading users...' }}</p>
                                    </div>
                                </div>
                            </div>
                            <table class="min-w-full divide-y divide-slate-300 dark:divide-slate-600">
                                <thead class="bg-slate-50 dark:bg-slate-700">
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
                                            class="pr-3 py-4 text-left text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap dark:text-slate-200"
                                        >
                                            @if(!$selected)
                                                {{ __('Name') }}
                                            @else
                                                <span>{{ trans(':count selected', ['count' => count($selected)]) }}</span>
                                                <button
                                                    wire:click.prevent="exportCSV"
                                                    type="button"
                                                    class="inline-flex items-center rounded border border-slate-300 bg-white px-2.5 py-1.5 -my-2 text-xs font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none"
                                                >
                                                    {{ __('Export') }}
                                                </button>
                                                @if($users->total() > $users->count())
                                                    <button
                                                        wire:click="$toggle('selectAll')"
                                                        class="text-blue-600 hover:text-blue-500"
                                                    >
                                                        {{ $selectAll ? __('Clear selection') : __('Select all :count notifications', ['count' => $users->total()]) }}
                                                    </button>
                                                @endif
                                            @endif
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-4 text-center text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap dark:text-slate-200"
                                        >
                                            {{ __('Tickets') }}
                                        </th>
                                        <th
                                            scope="col"
                                            class="pl-3 pr-4 py-4 text-right text-xs font-medium uppercase tracking-wide text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-200"
                                        >
                                            {{ __('Joined on') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 bg-white dark:bg-slate-800 dark:divide-slate-600">
                                    @forelse($users as $user)
                                        <tr
                                            wire:loading.class.delay="opacity-50"
                                            class="hover:bg-slate-50 dark:hover:bg-slate-700/25"
                                        >
                                            <td class="relative w-8 px-6 sm:px-8">
                                                @if(in_array($user->id, $selected))
                                                    <div class="absolute inset-y-0 left-0 w-0.5 bg-blue-500 dark:bg-blue-400"></div>
                                                @endif
                                                <x-checkbox
                                                    wire:model="selected"
                                                    wire:key="checkbox-{{ $user->id }}"
                                                    value="{{ $user->id }}"
                                                    class="absolute left-4 top-1/2 -mt-2 sm:left-6"
                                                />
                                            </td>
                                            <td class="whitespace-nowrap pr-3 py-4 font-medium text-sm text-slate-900 dark:text-slate-200">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img
                                                            class="h-10 w-10 rounded-full bg-slate-200"
                                                            src="{{ $user->getFirstMediaUrl('avatar') }}"
                                                            alt="{{ __(':user avatar', ['user' => $user->name]) }}"
                                                        >
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="font-medium text-slate-900 dark:text-slate-200">
                                                            <a href="{{ route('agent.users.details', $user) }}" @class(['hover:text-blue-500 hover:underline dark:hover:text-blue-400', 'line-through' => $user->isBanned()])>
                                                                {{ $user->name }}
                                                            </a>
                                                        </div>
                                                        <div class="text-slate-500 dark:text-slate-400">
                                                            {{ $user->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-center text-sm text-slate-500 dark:text-slate-400">
                                                {{ $user->tickets_count }}
                                            </td>
                                            <td class="whitespace-nowrap pr-4 pl-3 py-4 text-right text-sm text-slate-500 sm:pr-6 dark:text-slate-400">
                                                {{ $user->created_at->toFormattedDateString() }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr wire:loading.class.delay="opacity-50">
                                            <td
                                                colspan="3"
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
            @if($users->hasPages())
                <x-slot:footer>
                    {{ $users->links() }}
                </x-slot:footer>
            @endif
        </x-card>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('message.sent', () => {
                    window.dispatchEvent(new CustomEvent('loading', {detail: {loading: true}}));
                });
                Livewire.hook('message.processed', () => {
                    window.dispatchEvent(new CustomEvent('loading', {detail: {loading: false}}));
                });
            });
        </script>
    @endpush
</div>
