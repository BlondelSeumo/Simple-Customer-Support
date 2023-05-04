<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Settings') }}
        </h1>
    </div>

    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <x-agent-settings-navigation wire:ignore />

        <div class="mt-10 space-y-6">
            <!-- Meta tag -->
            <form wire:submit.prevent="saveHomepageInformation">
                <x-accordion>
                    <x-slot:title>
                        {{ __('Home page information') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Manage how information is displayed on your home page.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveHomePageInformation"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="homepageMetaTitleInput"
                                        :value="__('Meta title')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="homepageMetaTitle"
                                            id="homepageMetaTitleInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="homepageMetaTitle"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="homepageMetaDescriptionInput"
                                        :value="__('Meta description')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="homepageMetaDescription"
                                            id="homepageMetaDescriptionInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="homepageMetaDescription"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="home-page-information-saved"
                                    class="mr-3"
                                />
                                <x-button.primary wire:loading.attr="disabled">
                                    {{ __('Save changes') }}
                                </x-button.primary>
                            </div>
                        </div>
                    </x-slot:content>
                </x-accordion>
            </form>

            <!-- Suggested searches -->
            <form wire:submit.prevent="saveHomepageSuggestedSearches">
                <x-accordion>
                    <x-slot:title>
                        {{ __('Home page search') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Manage suggested searches on home page.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveHomePageSuggestedSearches"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="homepageSuggestedSearchesInput"
                                        :value="__('Suggested searches')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="homepageSuggestedSearches"
                                            id="homepageSuggestedSearchesInput"
                                            type="text"
                                            placeholder="e.g. Cartify, Ticksify, Envato..."
                                        />
                                        <x-input-error
                                            for="homepageSuggestedSearches"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="home-page-suggested-searches-saved"
                                    class="mr-3"
                                />
                                <x-button.primary wire:loading.attr="disabled">
                                    {{ __('Save changes') }}
                                </x-button.primary>
                            </div>
                        </div>
                    </x-slot:content>
                </x-accordion>
            </form>

            <!-- Frequently asked Questions -->
            <form wire:submit.prevent="saveHomepageFrequentlyAskedQuestions">
                <x-accordion>
                    <x-slot:title>
                        {{ __('Home page FAQ') }}
                    </x-slot:title>

                    <x-slot:description>
                        {{ __('Manage a list of frequently asked questions and their answers on home page.') }}
                    </x-slot:description>

                    <x-slot:content>
                        <div class="border-b py-6 border-slate-200 dark:border-slate-600">
                            <fieldset
                                wire:target="saveHomePageFrequentlyAskedQuestions"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50"
                                class="space-y-6 sm:space-y-5"
                            >
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <x-label
                                        for="homepageFAQTitleInput"
                                        :value="__('Section title')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="homepageFAQTitle"
                                            id="homepageFAQTitleInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="homepageFAQTitle"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        for="homepageFAQDescriptionInput"
                                        :value="__('Section description')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <x-input
                                            wire:model.defer="homepageFAQDescription"
                                            id="homepageFAQDescriptionInput"
                                            type="text"
                                        />
                                        <x-input-error
                                            for="homepageFAQDescription"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-slate-200 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5 dark:sm:border-slate-600">
                                    <x-label
                                        :value="__('Questions and Answers')"
                                        class="sm:mt-px sm:pt-2"
                                    />
                                    <div class="mt-1 space-y-3 sm:col-span-2 sm:mt-0">
                                        @foreach($homepageFAQItems as $item)
                                            <div class="group isolate relative -space-y-px rounded-md shadow-sm">
                                                <div class="relative rounded-md rounded-b-none border border-slate-300 px-3 py-2 focus-within:z-10 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600 dark:border-slate-500 dark:text-slate-200 dark:focus-within:ring-blue-500 dark:focus-within:border-blue-500">
                                                    <x-label
                                                        for="questionInput[{{ $loop->index }}]"
                                                        :value="__('Question')"
                                                        class="!text-xs"
                                                    />
                                                    <x-input
                                                        wire:model.defer="homepageFAQItems.{{ $loop->index }}.question"
                                                        id="questionInput[{{ $loop->index }}]"
                                                        type="text"
                                                        class="border-0 p-0 !shadow-none focus:ring-0"
                                                        placeholder="{{ __('Enter the question') }}"
                                                    />
                                                    <x-input-error for="homepageFAQItems.{{ $loop->index }}.question" />
                                                </div>
                                                <div class="relative rounded-md rounded-t-none border border-slate-300 px-3 py-2 focus-within:z-10 focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600 dark:border-slate-500 dark:text-slate-200 dark:focus-within:ring-blue-500 dark:focus-within:border-blue-500">
                                                    <x-label
                                                        for="answerInput[{{ $loop->index }}]"
                                                        :value="__('Answer')"
                                                        class="!text-xs"
                                                    />
                                                    <x-input
                                                        wire:model.defer="homepageFAQItems.{{ $loop->index }}.answer"
                                                        id="answerInput[{{ $loop->index }}]"
                                                        type="text"
                                                        class="border-0 p-0 !shadow-none focus:ring-0"
                                                        placeholder="{{ __('Enter the answer') }}"
                                                    />
                                                    <x-input-error for="homepageFAQItems.{{ $loop->index }}.answer" />
                                                </div>
                                                <button
                                                    wire:click="deleteHomepageFAQItem({{ $loop->index }})"
                                                    type="button"
                                                    class="hidden absolute bg-white -top-2 -right-2 group-focus-within:block group-focus-within:z-20 group-hover:block dark:bg-slate-800"
                                                >
                                                    <x-heroicon-m-x-circle class="w-5 h-5 text-slate-400 hover:text-red-500" />
                                                </button>
                                            </div>
                                        @endforeach

                                        <div class="mt-1">
                                            <x-button.secondary
                                                wire:click="addHomepageFAQItem"
                                                class="block w-full"
                                            >
                                                <x-heroicon-m-plus class="-ml-1 mr-2 h-5 w-5" />
                                                {{ __('Add question') }}
                                            </x-button.secondary>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <div class="flex items-center justify-end">
                                <x-action-message
                                    on="home-page-faq-saved"
                                    class="mr-3"
                                />
                                <x-button.primary wire:loading.attr="disabled">
                                    {{ __('Save changes') }}
                                </x-button.primary>
                            </div>
                        </div>
                    </x-slot:content>
                </x-accordion>
            </form>
        </div>
    </div>
</div>
