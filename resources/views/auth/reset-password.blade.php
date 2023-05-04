<x-blank-layout>
    <div class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
                <a href="/">
                    <img
                        src="{{ $generalSettings->favicon_path ? Storage::url($generalSettings->favicon_path) : asset('img/logo-blue.png') }}"
                        alt="{{ $generalSettings->site_name ?? config('app.name') }}"
                        class="h-12 w-auto"
                    >
                </a>
                <h2 class="mt-6 text-3xl font-display tracking-tight text-slate-900">
                    {{ __('Update your password') }}
                </h2>
            </div>

            <div class="mt-8">
                <!-- Validation Errors -->
                <x-auth-validation-errors
                    class="rounded-md bg-red-50 p-4 mb-4"
                    :errors="$errors"
                />

                <div class="mt-6">
                    <form
                        method="POST"
                        action="{{ route('password.update') }}"
                    >
                        @csrf
                        <!-- Password Reset Token -->
                        <input
                            type="hidden"
                            name="token"
                            value="{{ $request->route('token') }}"
                        >
                        <!-- Email Address -->
                        <div>
                            <x-label
                                for="email"
                                :value="__('Email')"
                            />
                            <x-input
                                id="email"
                                class="mt-1"
                                type="email"
                                name="email"
                                :value="old('email', $request->email)"
                                required
                                autofocus
                            />
                        </div>
                        <!-- Password -->
                        <div class="mt-4">
                            <x-label
                                for="password"
                                :value="__('Password')"
                            />
                            <x-input
                                id="password"
                                class="mt-1"
                                type="password"
                                name="password"
                                required
                            />
                        </div>
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label
                                for="password_confirmation"
                                :value="__('Confirm Password')"
                            />
                            <x-input
                                id="password_confirmation"
                                class="mt-1"
                                type="password"
                                name="password_confirmation"
                                required
                            />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button.primary>
                                {{ __('Update Password') }}
                            </x-button.primary>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="relative hidden w-0 flex-1 lg:block">
        <img
            class="absolute inset-0 h-full w-full object-cover"
            src="{{ asset('img/background-auth.jpg') }}"
            alt=""
        >
    </div>
</x-blank-layout>
