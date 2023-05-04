<div>
    <x-slot:title>
        {{ __('Submit ticket') }}
    </x-slot:title>

    <x-slot:header>
        <div class="relative py-6 max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-5xl lg:px-8">
            <h1 class="font-display font-medium tracking-tight text-white text-4xl">
                {{ __('Submit new Ticket') }}
            </h1>
        </div>
    </x-slot:header>

    <div class="-mt-32 relative max-w-3xl mx-auto sm:px-6 lg:max-w-5xl lg:px-8">
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="divide-y divide-slate-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                @include('layouts.navigation-user')

                <div class="lg:col-span-9 min-h-[500px]">
                    <div class="border-b border-slate-200 pl-4 pr-6 pt-4 pb-4 sm:pl-6 lg:pl-8 xl:pl-6 xl:pt-6">
                        <div class="flex items-center">
                            <h1 class="flex-1 font-display text-lg">
                                {{ __('Submit new ticket') }}
                            </h1>
                        </div>
                    </div>
                    <form wire:submit.prevent="submit">
                        <div class="px-4 py-6 sm:p-6">
                            <fieldset
                                class="space-y-4 disabled:opacity-50"
                                wire:loading.attr="disabled"
                            >
                                <!-- Product -->
                                <div>
                                    <x-label
                                        for="productSelect"
                                        :value="__('Product')"
                                    />
                                    <div class="relative mt-1">
                                        <x-dropdown
                                            align="top"
                                            width="full"
                                        >
                                            <x-slot:trigger>
                                                <button
                                                    type="button"
                                                    class="relative w-full cursor-default rounded-md border border-slate-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 sm:text-sm"
                                                >
                                                    @if($selectedProduct)
                                                        <span class="flex items-center">
                                                            @if($selectedProduct->hasMedia('logo'))
                                                                <img
                                                                    src="{{ $selectedProduct->getFirstMediaUrl('logo') }}"
                                                                    alt="{{ $selectedProduct->name }}"
                                                                    class="h-5 w-5 flex-shrink-0 rounded-full"
                                                                >
                                                            @else
                                                                <x-heroicon-o-cube class="h-5 w-5 flex-shrink-0 rounded-full text-slate-600" />
                                                            @endif
                                                            <span class="ml-3 block truncate">{{ $selectedProduct->name }}</span>
                                                        </span>
                                                    @else
                                                        <span class=" block truncate">{{ __('Please select a product') }}</span>
                                                    @endif
                                                    <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-3">
                                                        <x-heroicon-m-chevron-up-down class="h-5 w-5 text-slate-400" />
                                                    </span>
                                                </button>
                                            </x-slot:trigger>
                                            <x-slot:content>
                                                <div class="max-h-80 overflow-y-auto">
                                                    @forelse($this->products as $product)
                                                        <x-dropdown-link
                                                            wire:click="$set('ticket.product_id', {{ $product->id }})"
                                                            role="button"
                                                            class="-ml-1 relative"
                                                        >
                                                            <div class="flex items-center">
                                                                @if($product->hasMedia('logo'))
                                                                    <img
                                                                        src="{{ $product->getFirstMediaUrl('logo') }}"
                                                                        alt="{{ $product->name }}"
                                                                        class="h-5 w-5 flex-shrink-0 rounded-full"
                                                                    >
                                                                @else
                                                                    <x-heroicon-o-cube class="h-5 w-5 flex-shrink-0" />
                                                                @endif
                                                                <span @class(['ml-3 block truncate', 'font-semibold' => $selectedProduct?->id == $product->id, 'font-normal' => $selectedProduct?->id != $product->id])>{{ $product->name }}</span>
                                                            </div>
                                                            @if($selectedProduct?->id == $product->id)
                                                                <span class="text-blue-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                                                    <x-heroicon-m-check class="h-5 w-5" />
                                                                </span>
                                                            @endif
                                                        </x-dropdown-link>
                                                    @empty
                                                        <x-dropdown-link
                                                            role="button"
                                                            class="-ml-1 relative"
                                                        >
                                                            {{ __('No products found') }}
                                                        </x-dropdown-link>
                                                    @endforelse
                                                </div>
                                            </x-slot:content>
                                        </x-dropdown>
                                    </div>
                                    <x-input-error
                                        for="ticket.product_id"
                                        class="mt-2"
                                    />
                                </div>
                                <!-- Category -->
                                <div>
                                    <x-label
                                        for="categorySelect"
                                        :value="__('Category')"
                                    />
                                    <div class="relative mt-1">
                                        <x-dropdown
                                            align="top"
                                            width="full"
                                        >
                                            <x-slot:trigger>
                                                <button
                                                    type="button"
                                                    class="relative w-full cursor-default rounded-md border border-slate-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 sm:text-sm"
                                                >
                                                    @if($selectedCategory)
                                                        <span class="block truncate">{{ $selectedCategory->name }}</span>
                                                    @else
                                                        <span class="block truncate">{{ __('Please select a category') }}</span>
                                                    @endif
                                                    <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-3">
                                                        <x-heroicon-m-chevron-up-down class="h-5 w-5 text-slate-400" />
                                                    </span>
                                                </button>
                                            </x-slot:trigger>
                                            <x-slot:content>
                                                <div class="max-h-80 overflow-y-auto">
                                                    @forelse($this->categories as $category)
                                                        <x-dropdown-link
                                                            wire:click="$set('ticket.category_id', {{ $category->id }})"
                                                            role="button"
                                                            class="-ml-1 relative"
                                                        >
                                                            <div class="flex items-center">
                                                                <span @class(['block truncate', 'font-semibold' => $selectedCategory?->id == $category->id, 'font-normal' => $selectedCategory?->id != $category->id])>{{ $category->name }}</span>
                                                            </div>
                                                            @if($selectedCategory?->id == $category->id)
                                                                <span class="text-blue-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                                                    <x-heroicon-m-check class="h-5 w-5" />
                                                                </span>
                                                            @endif
                                                        </x-dropdown-link>
                                                    @empty
                                                        <x-dropdown-link
                                                            role="button"
                                                            class="-ml-1 relative"
                                                        >
                                                            {{ __('No categories found') }}
                                                        </x-dropdown-link>
                                                    @endforelse
                                                </div>
                                            </x-slot:content>
                                        </x-dropdown>
                                    </div>
                                    <x-input-error
                                        for="ticket.category_id"
                                        class="mt-2"
                                    />
                                </div>
                                <!-- License code -->
                                @if($licenseRequired)
                                    <div>
                                        <x-label
                                            for="productLicenseCode"
                                            :value="$selectedProduct && $selectedProduct->provider === \App\Enums\ProductProvider::ENVATO ? __('Purchase code') : __('License code')"
                                        />
                                        <x-input
                                            wire:model.lazy="ticket.license_code"
                                            id="productLicenseCode"
                                            type="text"
                                            class="mt-1"
                                        />
                                        <x-input-error
                                            for="ticket.license_code"
                                            class="mt-2"
                                        />
                                    </div>
                                    @if(!$ticket->license_code && $selectedProduct && $selectedProduct->provider !== \App\Enums\ProductProvider::SELF_HOSTED && $this->envatoSettings->oauth_enabled)
                                        <div class="relative">
                                            <div
                                                class="absolute inset-0 flex items-center"
                                                aria-hidden="true"
                                            >
                                                <div class="w-full border-t border-slate-300"></div>
                                            </div>
                                            <div class="relative flex justify-center">
                                                <span class="bg-white px-2 text-sm text-slate-500">{{ __('OR') }}</span>
                                            </div>
                                        </div>
                                        <x-button.secondary
                                            wire:click="loadEnvatoPurchase"
                                            type="button"
                                            class="block w-full"
                                        >
                                            <x-icon-envato class="-ml-1 mr-2 h-5 w-5" />
                                            {{ __('Verify purchase with Envato') }}
                                        </x-button.secondary>
                                        <x-input-error
                                            for="verify-envato-purchase"
                                            class="mt-2 text-center"
                                        />
                                        <ul class="border border-slate-200 rounded-md divide-y divide-slate-200">
                                            @foreach($envatoPurchases->where('item.id', $selectedProduct->code)->all() as $purchase)
                                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                    <div class="w-0 flex-1 flex items-center">
                                                        <x-heroicon-m-key class="flex-shrink-0 h-5 w-5 text-slate-400" />
                                                        <span class="ml-2 flex-1 w-0 truncate">
                                                            {{ $purchase['code'] }}
                                                        </span>
                                                    </div>
                                                    <div class="ml-4 flex-shrink-0">
                                                        <button
                                                            wire:click="$set('ticket.license_code', '{{ $purchase['code'] }}')"
                                                            type="button"
                                                            class="font-medium text-blue-600 hover:text-blue-500"
                                                        >
                                                            {{ __('Use') }}
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                                <!-- Subject -->
                                <div>
                                    <x-label
                                        for="ticketSubject"
                                        :value="__('Subject')"
                                    />
                                    <x-input
                                        wire:model.defer="ticket.subject"
                                        id="ticketSubject"
                                        type="text"
                                        class="block mt-1 w-full"
                                        :placeholder="__('Briefly describe your problem.')"
                                    />
                                    <x-input-error
                                        for="ticket.subject"
                                        class="mt-2"
                                    />
                                </div>
                                <!-- Content -->
                                <div>
                                    <x-label
                                        for="ticketContent"
                                        :value="__('Content')"
                                    />
                                    <div class="mt-1">
                                        <x-tiptap-comment
                                            wire:ignore
                                            wire:model="ticket.content"
                                            id="ticketContent"
                                        />
                                    </div>
                                    <x-input-error
                                        for="ticket.content"
                                        class="mt-2"
                                    />
                                </div>
                                <!-- Attachment -->
                                @if($attachments)
                                    <ul class="border border-slate-200 rounded-md divide-y divide-slate-200">
                                        @foreach($attachments as $attachment)
                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <x-heroicon-s-paper-clip class="flex-shrink-0 h-5 w-5 text-slate-400" />
                                                    <span class="ml-2 flex-1 w-0 truncate">
                                                        {{ $attachment->getClientOriginalName() }}
                                                    </span>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <button
                                                        wire:click="removeAttachment({{ $loop->index }})"
                                                        type="button"
                                                        class="font-medium text-red-600 hover:text-red-500"
                                                    >
                                                        {{ __('Remove') }}
                                                    </button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                @error('attachments.*') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                                <div class="flex items-center justify-between">
                                    <div x-data>
                                        <input
                                            x-ref="fileInput"
                                            wire:model="attachments"
                                            type="file"
                                            class="sr-only"
                                            multiple
                                        >
                                        <a
                                            @click="$refs.fileInput.click()"
                                            role="button"
                                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-500"
                                        >
                                            <x-heroicon-o-paper-clip class="mr-1 w-4 h-4" />
                                            {{ __('Add attachment') }}
                                        </a>
                                    </div>
                                    <x-button.primary>
                                        {{ __('Submit') }}
                                    </x-button.primary>
                                </div>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
