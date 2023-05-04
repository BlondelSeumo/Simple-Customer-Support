<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Canned Responses') }}
        </h1>
        <div class="mt-4 sm:mt-0">
            <x-button.primary
                wire:click="createResponse"
                type="button"
            >
                <x-heroicon-m-plus class="-ml-1 mr-2 w-4 h-4" />
                {{ __('New response') }}
            </x-button.primary>
        </div>
    </div>

    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <x-card class="overflow-hidden rounded-lg">
            <x-slot:header>
                <div>
                    <x-input
                        wire:model.debounce.500ms="search"
                        type="search"
                        placeholder="{{ __('Search...') }}"
                    />
                </div>
            </x-slot:header>
            <x-slot:content>
                <ul
                    role="list"
                    class="-mx-4 -my-6 divide-y divide-slate-300 sm:-mx-6 dark:divide-slate-600"
                >
                    @if($isCreatingResponse || !$this->cannedResponses->count())
                        <form
                            wire:submit.prevent="saveResponse"
                            class="bg-slate-50 px-4 py-6 sm:px-6 space-y-5 dark:bg-slate-800"
                        >
                            <div>
                                <x-label
                                    for="title"
                                    :value="__('Title')"
                                />
                                <x-input
                                    wire:model="response.title"
                                    type="text"
                                    id="title"
                                    class="mt-1"
                                />
                                <x-input-error
                                    for="response.title"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <x-label
                                    for="content"
                                    :value="__('Content')"
                                />
                                <x-textarea
                                    wire:model="response.content"
                                    type="text"
                                    id="content"
                                    class="mt-1"
                                />
                                <x-input-error
                                    for="response.content"
                                    class="mt-2"
                                />
                            </div>
                            <div class="flex flex-row-reverse">
                                <x-button.primary class="ml-3">
                                    {{ __('Add response') }}
                                </x-button.primary>
                                <x-button.text wire:click="$set('isCreatingResponse', false)">
                                    {{ __('Cancel')}}
                                </x-button.text>
                            </div>
                        </form>
                    @endif

                    @foreach($this->cannedResponses as $item)
                        @if($isEditingResponse && $response->id == $item->id)
                            <form
                                wire:submit.prevent="saveResponse"
                                class="bg-slate-50 px-4 py-6 sm:px-6 space-y-5 dark:bg-slate-800"
                            >
                                <div>
                                    <x-label
                                        for="title"
                                        :value="__('Title')"
                                    />
                                    <x-input
                                        wire:model="response.title"
                                        type="text"
                                        id="title"
                                        class="mt-1"
                                    />
                                    <x-input-error
                                        for="response.title"
                                        class="mt-2"
                                    />
                                </div>
                                <div>
                                    <x-label
                                        for="content"
                                        :value="__('Content')"
                                    />
                                    <x-textarea
                                        wire:model="response.content"
                                        type="text"
                                        id="content"
                                        class="mt-1"
                                    />
                                    <x-input-error
                                        for="response.content"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="flex flex-row-reverse">
                                    <x-button.primary class="ml-3">
                                        {{ __('Save changes')}}
                                    </x-button.primary>
                                    <x-button.soft-danger
                                        x-on:click.prevent="if(confirm('{{ __('Are you sure you want to delete this item?') }}')) $wire.deleteResponse('{{ $response->id }}')"
                                        class="ml-3"
                                    >
                                        {{ __('Delete')}}
                                    </x-button.soft-danger>
                                    <x-button.text wire:click="$set('isEditingResponse', false)">
                                        {{ __('Cancel')}}
                                    </x-button.text>
                                </div>
                            </form>
                        @else
                            <li class="relative bg-white px-4 py-6 sm:px-6 hover:bg-slate-50 dark:bg-slate-800 dark:hover:bg-slate-700/25">
                                <h4 class="font-medium dark:text-slate-200">
                                    <a
                                        wire:click="editResponse('{{ $item->id }}')"
                                        role="button"
                                    >
                                        <span class="absolute inset-0"></span>
                                        {{ $item->title }}
                                    </a>
                                </h4>
                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {!! $item->content !!}
                                </p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </x-slot:content>
        </x-card>
    </div>
</div>
