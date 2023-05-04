<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:px-8">
        <h1 class="font-display text-3xl text-slate-900 dark:text-slate-200">
            {{ __('Account') }}
        </h1>
    </div>
    <div class="mt-4 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div x-data="{ activeTab: 'profile' }">
            <div class="sm:hidden">
                <x-label
                    for="tabs"
                    class="sr-only"
                    :value="__('Select a tab')"
                />
                <x-select
                    x-model="activeTab"
                    id="tabs"
                >
                    <option value="profile">{{ __('Profile') }}</option>
                    <option value="password">{{ __('Password') }}</option>
                </x-select>
            </div>

            <div class="hidden sm:block">
                <div class="border-b border-slate-200 dark:border-slate-600">
                    <nav
                        class="-mb-px flex space-x-8"
                        aria-label="Tabs"
                    >
                        <button
                            @click="activeTab = 'profile'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                            :class="{ 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200': activeTab === 'profile', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 dark:hover:border-slate-300': activeTab !== 'profile' }"
                        >
                            {{ __('Profile') }}
                        </button>

                        <button
                            @click="activeTab = 'password'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                            :class="{ 'border-blue-500 text-blue-600 dark:border-slate-200 dark:text-slate-200': activeTab === 'password', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 dark:hover:border-slate-300': activeTab !== 'password' }"
                        >
                            {{ __('Password') }}
                        </button>
                    </nav>
                </div>
            </div>

            <div x-show="activeTab === 'profile'">
                <livewire:agent.profile.general-form />
            </div>

            <div x-show="activeTab === 'password'">
                <livewire:agent.profile.password-form />
            </div>
        </div>
    </div>
</div>
