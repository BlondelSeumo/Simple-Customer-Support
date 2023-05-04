<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:px-8">
        <div class="flex items-center space-x-5">
            <div class="flex-shrink-0">
                <div class="relative">
                    <img
                        class="w-16 h-16 rounded-full bg-slate-200"
                        src="{{ $user->getFirstMediaUrl('avatar') }}"
                        alt="{{ __(':user avatar', ['user' => $user->name]) }}"
                    >
                    <span
                        class="absolute inset-0 shadow-inner rounded-full"
                        aria-hidden="true"
                    ></span>
                </div>
            </div>
            <div>
                <h1 @class(['font-display text-2xl text-slate-900 dark:text-slate-200', 'line-through' => $user->isBanned()])>
                    {{ $user->name }}
                </h1>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                    {{ __('Joined on') }}
                    <time datetime="{{ $user->created_at->toIso8601ZuluString() }}">{{ $user->created_at->toFormattedDateString() }}</time>
                </p>
            </div>
        </div>
        <div class="justify-stretch mt-6 flex flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
            @if($this->user->isBanned())
                <x-button.secondary
                    wire:click="unbanUser"
                    wire:target="unbanUser"
                    wire:loading.attr="disabled"
                >
                    {{ __('Unban User') }}
                </x-button.secondary>
            @else
                <x-button.soft-danger
                    wire:click="banUser"
                    wire:target="banUser"
                    wire:loading.attr="disabled"
                >
                    {{ __('Ban User') }}
                </x-button.soft-danger>
            @endif
        </div>
    </div>

    <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 px-4 sm:px-6 lg:px-8">
        <x-card class="relative rounded-lg overflow-hidden">
            <x-slot:header>
                <h3 class="font-display text-lg leading-6 text-slate-900 dark:text-slate-200">
                    {{ __('User profile') }}
                </h3>
            </x-slot:header>
            <x-slot:content>
                <div class="-mx-4 -my-6 overflow-x-auto sm:-mx-6">
                    <dl class="divide-y divide-slate-200 dark:divide-slate-600">
                        <!-- Name form -->
                        <form
                            wire:submit.prevent="updateUserName"
                            x-data="{ isUpdating: false }"
                            x-on:user-name-updated.window="isUpdating = false"
                            class="items-center p-4 sm:px-6 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4"
                        >
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Name') }}</dt>
                            <dd class="mt-1 flex items-center text-sm text-slate-900 sm:mt-0 sm:col-span-2 dark:text-slate-200">
                                <div
                                    x-show="!isUpdating"
                                    class="flex items-center w-full"
                                >
                                    <span class="flex-grow">
                                        {{ $user->name }}
                                    </span>
                                    <div class="ml-4 flex-shrink-0">
                                        <button
                                            x-on:click="isUpdating = true"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                                <div
                                    x-cloak
                                    x-show="isUpdating"
                                    x-trap="isUpdating"
                                    class="flex items-center w-full"
                                >
                                    <x-input
                                        wire:model.defer="name"
                                        type="text"
                                        class="flex-grow"
                                        placeholder="{{ $user->name }}"
                                    />
                                    <div class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                        <button
                                            x-on:click="isUpdating = false"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Cancel') }}
                                        </button>
                                        <span
                                            class="text-slate-300 dark:text-slate-600"
                                            aria-hidden="true"
                                        >|</span>
                                        <button
                                            type="submit"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </dd>
                            <x-input-error
                                for="name"
                                class="mt-2 sm:mt-0 sm:col-start-2 sm:col-span-2"
                            />
                        </form>
                        <!-- Email form -->
                        <form
                            wire:submit.prevent="updateUserEmail"
                            x-data="{ isUpdating: false }"
                            x-on:user-email-updated.window="isUpdating = false"
                            class="items-center p-4 sm:px-6 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4"
                        >
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Email') }}</dt>
                            <dd class="mt-1 flex items-center text-sm text-slate-900 sm:mt-0 sm:col-span-2 dark:text-slate-200">
                                <div
                                    x-show="!isUpdating"
                                    class="flex items-center w-full"
                                >
                                    <span class="flex-grow">
                                        {{ $user->email }}
                                    </span>
                                    <div class="ml-4 flex-shrink-0">
                                        <button
                                            x-on:click="isUpdating = true"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                                <div
                                    x-cloak
                                    x-show="isUpdating"
                                    x-trap="isUpdating"
                                    class="flex items-center w-full"
                                >
                                    <x-input
                                        wire:model.defer="email"
                                        type="text"
                                        class="flex-grow"
                                        placeholder="{{ $user->email }}"
                                    />
                                    <div class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                        <button
                                            x-on:click="isUpdating = false"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Cancel') }}
                                        </button>
                                        <span
                                            class="text-slate-300 dark:text-slate-600"
                                            aria-hidden="true"
                                        >|</span>
                                        <button
                                            type="submit"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </dd>
                            <x-input-error
                                for="email"
                                class="mt-2 sm:mt-0 sm:col-start-2 sm:col-span-2"
                            />
                        </form>
                        <!-- Avatar form -->
                        <div
                            x-data
                            class="items-center p-4 sm:px-6 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5"
                        >
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Photo') }}</dt>
                            <dd class="mt-1 flex text-sm text-slate-900 sm:mt-0 sm:col-span-2">
                                <span class="flex-grow">
                                    @if($avatar)
                                        <img
                                            class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-600"
                                            src="{{ $avatar->temporaryUrl() }}"
                                            alt=""
                                        >
                                    @else
                                        <img
                                            class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-600"
                                            src="{{ $user->getFirstMediaUrl('avatar') }}"
                                            alt="{{ __(':user avatar', ['user' => $user->name]) }}"
                                        >
                                    @endif
                                    <x-input
                                        wire:model.defer="avatar"
                                        x-ref="photoInput"
                                        type="file"
                                        class="hidden"
                                    />
                                </span>
                                <div class="ml-4 flex-shrink-0 flex items-center space-x-4">
                                    <button
                                        x-on:click="$refs.photoInput.click()"
                                        type="button"
                                        class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                    >
                                        {{ $this->avatar ? __('Change') : __('Update') }}
                                    </button>
                                    @if($this->avatar)
                                        <span
                                            class="text-slate-300 dark:text-slate-600"
                                            aria-hidden="true"
                                        >|</span>
                                        <button
                                            wire:click="updateUserPhoto"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Save') }}
                                        </button>
                                    @endif
                                    @if($this->user->hasMedia('avatar'))
                                        <span
                                            class="text-slate-300 dark:text-slate-600"
                                            aria-hidden="true"
                                        >|</span>
                                        <button
                                            wire:click="removeUserPhoto"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Remove') }}
                                        </button>
                                    @endif
                                </div>
                            </dd>
                        </div>
                        <!-- Password form -->
                        <form
                            wire:submit.prevent="updateUserPassword"
                            x-data="{ isUpdating: false }"
                            x-on:user-password-updated.window="isUpdating = false"
                            class="items-center p-4 sm:px-6 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4"
                        >
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Password') }}</dt>
                            <dd class="mt-1 flex items-center text-sm text-slate-900 sm:mt-0 sm:col-span-2 dark:text-slate-200">
                                <div
                                    x-show="!isUpdating"
                                    class="flex items-center w-full"
                                >
                                    <span class="flex-grow">
                                        {{ __('**********') }}
                                    </span>
                                    <div class="ml-4 flex-shrink-0">
                                        <button
                                            x-on:click="isUpdating = true"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                                <div
                                    x-cloak
                                    x-show="isUpdating"
                                    x-trap="isUpdating"
                                    class="flex items-center w-full"
                                >
                                    <x-input
                                        wire:model.defer="password"
                                        type="password"
                                        class="flex-grow"
                                        placeholder="**********"
                                    />
                                    <div class="ml-4 flex-shrink-0 flex items-start space-x-4">
                                        <button
                                            x-on:click="isUpdating = false"
                                            type="button"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Cancel') }}
                                        </button>
                                        <span
                                            class="text-slate-300 dark:text-slate-600"
                                            aria-hidden="true"
                                        >|</span>
                                        <button
                                            type="submit"
                                            class="rounded-md font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300 dark:focus:ring-offset-slate-800"
                                        >
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </dd>
                            <x-input-error
                                for="password"
                                class="mt-2 sm:mt-0 sm:col-start-2 sm:col-span-2"
                            />
                        </form>
                    </dl>
                </div>
            </x-slot:content>
        </x-card>

        <x-card class="relative rounded-lg overflow-hidden">
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <h3 class="font-display text-lg leading-6 text-slate-900 dark:text-slate-200">
                        {{ __('Recently submitted tickets') }}
                    </h3>
                    @if($this->submittedTickets->count())
                        <a
                            href="{{ route('agent.tickets.list', ['author' => $user->id]) }}"
                            class="font-medium text-sm text-blue-600 hover:text-blue-500 dark:text-slate-300 dark:hover:text-slate-200"
                        >
                            {{ __('View all') }}
                        </a>
                    @endif
                </div>
            </x-slot:header>
            <x-slot:content>
                <div class="-mx-4 -my-6 overflow-x-auto sm:-mx-6">
                    @if($this->submittedTickets->count())
                        <ul class="divide-y divide-slate-200 dark:divide-slate-600">
                            @foreach($this->submittedTickets as $ticket)
                                <li class="relative px-4 py-2 text-sm sm:px-6 hover:bg-slate-50 dark:hover:bg-slate-700/25">
                                    <a
                                        href="{{ route('agent.tickets.details', $ticket) }}"
                                        class="font-medium text-slate-700 truncate hover:text-blue-500 hover:underline dark:text-slate-200 dark:hover:text-blue-400"
                                    >
                                        {{ $ticket->subject }}
                                    </a>
                                    <p class="text-slate-500 dark:text-slate-400">
                                        {{ __('Submitted on :date', ['date' => $ticket->created_at->toFormattedDateString()]) }}
                                        {{ __('and is :status', ['status' => $ticket->status->label()]) }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="px-4 py-5 text-sm text-slate-600 sm:px-6 dark:text-slate-400">
                            {{ __('User has not submitted any tickets yet.') }}
                        </div>
                    @endif
                </div>
            </x-slot:content>
        </x-card>
    </div>
</div>
