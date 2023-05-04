<x-blank-layout>
    <div class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        @unless($generalSettings->enable_user_registration)
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <x-heroicon-m-lock-closed class="h-5 w-5 text-red-400" />
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                {{ __('Whoop!') }}
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <p>{{ __('Registration is currently disabled.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
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
                        {{ __('Sign up for a new account') }}
                    </h2>
                </div>
                <div class="mt-8">
                    @if(app(App\Settings\EnvatoSettings::class)->oauth_enabled)
                        <div>
                            <div>
                                <p class="text-sm font-medium text-slate-700 sr-only">
                                    {{ __('Sign in with') }}
                                </p>
                                <div class="mt-1">
                                    <div>
                                        <a
                                            href="{{ route('social-login.handler', ['provider' => 'envato']) }}"
                                            class="inline-flex w-full justify-center rounded-md border border-slate-300 bg-white py-2 px-4 text-sm font-medium text-slate-500 shadow-sm hover:bg-slate-50"
                                        >
                                            <x-icon-envato class="-ml-1 mr-2 w-5 h-5" />
                                            <span>{{ __('Sign up with Envato') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="relative my-6">
                                <div
                                    class="absolute inset-0 flex items-center"
                                    aria-hidden="true"
                                >
                                    <div class="w-full border-t border-slate-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="bg-white px-2 text-slate-500">{{ __('Or continue with') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Session Status -->
                    <x-auth-session-status
                        class="rounded-md bg-green-50 p-4 mb-4"
                        :status="session('status')"
                    />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors
                        class="rounded-md bg-red-50 p-4 mb-4"
                        :errors="$errors"
                    />

                    <div class="mt-6">
                        <form
                            action="{{ route('register') }}"
                            method="POST"
                            class="space-y-6"
                        >
                            @csrf
                            <!-- Name -->
                            <div>
                                <x-label
                                    for="name"
                                    :value="__('Name')"
                                />
                                <x-input
                                    id="name"
                                    class="mt-1"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required
                                    autofocus
                                />
                            </div>
                            <!-- Email -->
                            <div>
                                <x-label
                                    for="email"
                                    :value="__('Email')"
                                />
                                <div class="mt-1">
                                    <x-input
                                        id="email"
                                        type="text"
                                        name="email"
                                        :value="old('name')"
                                        autocomplete="email"
                                        required
                                    />
                                </div>
                            </div>
                            <!-- Password -->
                            <div>
                                <x-label
                                    for="password"
                                    :value="__('Password')"
                                />
                                <div class="mt-1">
                                    <x-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="current-password"
                                        required
                                    />
                                </div>
                            </div>
                            <!-- Confirm Password -->
                            <div>
                                <x-label
                                    for="password_confirmation"
                                    :value="__('Confirm Password')"
                                />
                                <x-input
                                    id="password_confirmation"
                                    class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                />
                            </div>
                            <!-- Captcha -->
                            @if($generalSettings->recaptcha_enabled)
                                <div>
                                    <div class="bg-slate-100 p-4 rounded-md text-sm text-slate-600">
                                        This site is protected by reCAPTCHA and the Google
                                        <a
                                            href="https://policies.google.com/privacy"
                                            class="hover:text-slate-500"
                                            tabindex="-1"
                                        >Privacy Policy</a> and
                                        <a
                                            href="https://policies.google.com/terms"
                                            class="hover:text-slate-500"
                                            tabindex="-1"
                                        >Terms of Service</a> apply.
                                    </div>
                                    <div
                                        id="signup_id"
                                        style="display: none;"
                                    ></div>
                                    {!! GoogleReCaptchaV3::render(['signup_id' => 'register']) !!}
                                </div>
                            @endif
                            <div>
                                <x-button.primary class="block w-full">
                                    {{ __('Register') }}
                                </x-button.primary>
                            </div>
                            <div>
                                <p class="text-sm text-center text-slate-600">
                                    {{ __('Already have an account?') }}
                                    <a
                                        href="{{ route('login') }}"
                                        class="font-medium text-blue-600 hover:text-blue-500"
                                    >
                                        {{ __('Sign in') }}
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endunless
    </div>
    <div class="relative hidden w-0 flex-1 lg:block">
        <img
            class="absolute inset-0 h-full w-full object-cover"
            src="{{ asset('img/background-auth.jpg') }}"
            alt=""
        >
    </div>
</x-blank-layout>
