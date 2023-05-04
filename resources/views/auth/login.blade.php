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
                    {{ __('Sign in to your account') }}
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
                                        <span>{{ __('Sign in with Envato') }}</span>
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
                        action="{{ route('login') }}"
                        method="POST"
                        class="space-y-6"
                    >
                        @csrf
                        <div class="space-y-1">
                            <x-label
                                for="email"
                                :value="__('Email')"
                            />
                            <div class="mt-1">
                                <x-input
                                    id="email"
                                    type="text"
                                    name="email"
                                    autocomplete="email"
                                    required
                                    autofocus
                                />
                            </div>
                        </div>

                        <div class="space-y-1">
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

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <x-checkbox
                                    id="remember-me"
                                    name="remember-me"
                                    :value="__('Remember me')"
                                />
                                <x-label
                                    for="remember-me"
                                    :value="__('Remember me')"
                                    class="ml-2"
                                />
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a
                                        href="{{ route('password.request') }}"
                                        class="font-medium text-blue-600 hover:text-blue-500"
                                        tabindex="-1"
                                    >
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </div>
                            @endif
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
                                    id="login_id"
                                    style="display: none;"
                                ></div>
                                {!! GoogleReCaptchaV3::render(['login_id' => 'login']) !!}
                            </div>
                        @endif

                        <div>
                            <x-button.primary class="block w-full">
                                {{ __('Sign in') }}
                            </x-button.primary>
                        </div>

                        <div>
                            <p class="text-sm text-center text-slate-600">
                                {{ __('Don\'t have an account?') }}
                                <a
                                    href="{{ route('register') }}"
                                    class="font-medium text-blue-600 hover:text-blue-500"
                                >
                                    {{ __('Sign up') }}
                                </a>
                            </p>
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
