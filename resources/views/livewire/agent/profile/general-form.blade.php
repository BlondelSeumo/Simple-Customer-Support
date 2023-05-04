<div>
    <form
        wire:submit.prevent="submit"
        class="mt-10 space-y-8 divide-y divide-slate-200 dark:divide-slate-600"
    >
        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
            <div class="sm:col-span-6">
                <h2 class="text-xl font-medium text-slate-900 dark:text-slate-200">
                    {{ __('Profile') }}
                </h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('This information will be displayed publicly so be careful what you share.') }}
                </p>
            </div>
            <div class="sm:col-span-3">
                <x-label
                    for="name"
                    :value="__('Name')"
                />
                <x-input
                    wire:model.defer="name"
                    type="text"
                    class="mt-1 block w-full"
                />
                <x-input-error
                    for="name"
                    class="mt-2"
                />
            </div>
            <div class="sm:col-span-3">
                <x-label
                    for="email"
                    :value="__('Email')"
                />
                <x-input
                    wire:model.defer="email"
                    type="email"
                    class="mt-1 block w-full"
                />
                <x-input-error
                    for="email"
                    class="mt-2"
                />
            </div>
            <div
                x-data="{ photoName: null, photoPreview: null }"
                class="sm:col-span-6"
            >
                <x-label
                    for="avatar"
                    :value="__('Avatar')"
                />
                <div class="mt-1 flex items-center">
                    <div x-show="!photoPreview">
                        <img
                            src="{{ $this->agent->getFirstMediaUrl('avatar') }}"
                            alt="{{ $this->agent->name }}"
                            class="inline-block h-12 w-12 rounded-full"
                        >
                    </div>
                    <div
                        x-cloak
                        x-show="photoPreview"
                    >
                        <span
                            class="block rounded-full w-12 h-12 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                        ></span>
                    </div>
                    <div class="ml-4 flex">
                        <div>
                            <x-input
                                wire:model.defer="avatar"
                                x-ref="photo"
                                x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                                "
                                type="file"
                                class="hidden"
                            />
                            <x-button.secondary @click="$refs.photo.click();">
                                {{ __('Change') }}
                            </x-button.secondary>
                        </div>
                        @if($this->agent->hasMedia('avatar'))
                            <x-button.text
                                wire:click="removeAvatar"
                                class="ml-3"
                            >
                                {{ __('Remove') }}
                            </x-button.text>
                        @endif
                    </div>
                </div>
                <x-input-error
                    for="avatar"
                    class="mt-2"
                />
            </div>
            <div class="sm:col-span-6">
                <x-label
                    for="about"
                    :value="__('About')"
                />
                <x-textarea
                    wire:model.defer="about"
                    rows="3"
                    class="mt-1"
                    :placeholder="__('Write something about you.')"
                />
                <x-input-error
                    for="about"
                    class="mt-2"
                />
            </div>
        </div>
        <div class="pt-8 flex justify-end space-x-3">
            <x-button.text>
                {{ __('Cancel') }}
            </x-button.text>
            <x-button.primary wire:loading.attr="disabled">
                {{ __('Save changes') }}
            </x-button.primary>
        </div>
    </form>
</div>
