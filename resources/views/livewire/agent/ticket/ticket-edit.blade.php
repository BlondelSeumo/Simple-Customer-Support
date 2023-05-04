<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Edit ticket #:id', ['id' => $ticket->id]) }}
        </h1>
        <div class="justify-stretch mt-6 flex flex-shrink-0 flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
            <a
                href="{{ route('agent.tickets.details', $ticket) }}"
                class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-700 bg-white border border-slate-300 leading-5 rounded-md hover:text-slate-500 focus:outline-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-500 dark:hover:text-slate-200 dark:focus:ring-offset-slate-800"
            >
                {{ __('Back') }}
            </a>
            <x-button.primary
                wire:click="save"
                type="button"
            >
                {{ __('Save changes') }}
            </x-button.primary>
        </div>
    </div>

    <div class="mt-6 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="pt-8 border-t border-slate-200 space-y-4 dark:border-slate-600">
            <form wire:submit.prevent="save">
                <fieldset
                    wire:loading.delay.attr="disabled"
                    class="grid grid-cols-3 gap-6"
                >
                    <!-- Product -->
                    <div class="col-span-3">
                        <x-label
                            for="product"
                            :value="__('Product')"
                        />
                        <x-select
                            wire:model.defer="ticket.product_id"
                            id="product"
                            class="block w-full mt-1"
                        >
                            <option value="">{{ __('Select a product') }}</option>
                            @foreach($this->products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error
                            for="ticket.product"
                            class="mt-2"
                        />
                    </div>
                    <!-- Category -->
                    <div class="col-span-3 sm:col-span-1">
                        <x-label
                            for="category"
                            :value="__('Category')"
                        />
                        <x-select
                            wire:model.defer="ticket.category_id"
                            id="category"
                            class="block w-full mt-1"
                        >
                            <option value="">{{ __('Select a category') }}</option>
                            @foreach($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error
                            for="ticket.category_id"
                            class="mt-2"
                        />
                    </div>
                    <!-- Priority -->
                    <div class="col-span-3 sm:col-span-1">
                        <x-label
                            for="priority"
                            :value="__('Priority')"
                        />
                        <x-select
                            wire:model.defer="ticket.priority"
                            id="priority"
                            class="block w-full mt-1"
                        >
                            @foreach(\App\Enums\TicketPriority::cases() as $priority)
                                <option value="{{ $priority }}">{{ $priority->label() }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error
                            for="ticket.priority"
                            class="mt-2"
                        />
                    </div>
                    <!-- Status -->
                    <div class="col-span-3 sm:col-span-1">
                        <x-label
                            for="status"
                            :value="__('Status')"
                        />
                        <x-select
                            wire:model.defer="ticket.status"
                            id="status"
                            class="block w-full mt-1"
                        >
                            @foreach(\App\Enums\TicketStatus::cases() as $status)
                                <option value="{{ $status }}">{{ $status->label() }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error
                            for="ticket.status"
                            class="mt-2"
                        />
                    </div>
                    <!-- Subject -->
                    <div class="col-span-3">
                        <x-label
                            for="subject"
                            :value="__('Subject')"
                        />
                        <x-input
                            wire:model.defer="ticket.subject"
                            id="subject"
                            type="text"
                            class="block w-full mt-1"
                        />
                        <x-input-error
                            for="ticket.subject"
                            class="mt-2"
                        />
                    </div>
                    <!-- Content -->
                    <div class="col-span-3">
                        <x-label
                            for="content"
                            :value="__('Content')"
                        />
                        <div
                            wire:target="save"
                            wire:loading.delay.class="opacity-50 pointer-events-none"
                            class="mt-1"
                        >
                            <x-tiptap-comment
                                wire:ignore
                                wire:model.defer="ticket.content"
                                id="content"
                            />
                        </div>
                        <x-input-error
                            for="ticket.content"
                            class="mt-2"
                        />
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
