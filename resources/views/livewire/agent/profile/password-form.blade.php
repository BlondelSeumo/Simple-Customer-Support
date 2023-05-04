<div>
    <form
        wire:submit.prevent="submit"
        x-cloak
        class="mt-10 space-y-8 divide-y divide-slate-200 dark:divide-slate-600"
    >
        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
            <div class="sm:col-span-6">
                <h2 class="text-xl font-medium text-slate-900 dark:text-slate-200">
                    {{ __('Password') }}
                </h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Update your login password.') }}
                </p>
            </div>
            <div class="sm:col-span-3">
                <x-label
                    for="password"
                    :value="__('New Password')"
                />
                <x-input
                    wire:model.defer="password"
                    type="password"
                    class="mt-1"
                />
                <x-input-error
                    for="password"
                    class="mt-2"
                />
            </div>
            <div class="sm:col-span-3">
                <x-label
                    for="password_confirmation"
                    :value="__('Confirm new password')"
                />
                <x-input
                    wire:model.defer="password_confirmation"
                    type="password"
                    class="mt-1"
                />
                <x-input-error
                    for="password_confirmation"
                    class="mt-2"
                />
            </div>
        </div>
        <div class="pt-8 flex justify-end space-x-3">
            <x-button.text>
                {{ __('Cancel') }}
            </x-button.text>
            <x-button.primary>
                {{ __('Save changes') }}
            </x-button.primary>
        </div>
    </form>
</div>
