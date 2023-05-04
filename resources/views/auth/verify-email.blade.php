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
                    {{ __('Thanks for signing up!') }}
                </h2>
            </div>

            <div class="my-4 text-sm text-slate-600">
                {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            <div class="mt-8">
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 p-4 font-medium text-sm bg-green-50 text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                <x-auth-validation-errors
                    class="rounded-md bg-red-50 p-4 mb-4"
                    :errors="$errors"
                />

                <div class="mt-6 flex items-center">
                    <form
                        method="POST"
                        action="{{ route('verification.send') }}"
                    >
                        @csrf

                        <div>
                            <x-button.primary>
                                {{ __('Resend Verification Email') }}
                            </x-button.primary>
                        </div>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <x-button.text type="submit">
                            {{ __('Log Out') }}
                        </x-button.text>
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
