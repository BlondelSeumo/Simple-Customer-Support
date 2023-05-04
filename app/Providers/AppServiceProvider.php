<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use App\Settings\LayoutSettings;
use App\Settings\ReCaptchaConfig;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;
use Livewire\Livewire;
use TimeHunter\LaravelGoogleReCaptchaV3\Interfaces\ReCaptchaConfigV3Interface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ReCaptchaConfigV3Interface::class,
            ReCaptchaConfig::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Component::macro('notify', function ($message) {
            $this->dispatchBrowserEvent('notify', $message);
        });

        Livewire::component('setup-wizard', \App\Http\Livewire\Setup\SetupWizard::class);
        Livewire::component('general-information-step', \App\Http\Livewire\Setup\GeneralInformationStep::class);
        Livewire::component('administrator-account-step', \App\Http\Livewire\Setup\AdministratorAccountStep::class);
        Livewire::component('finalize-setup-step', \App\Http\Livewire\Setup\FinalizeSetupStep::class);

        View::share('generalSettings', app(GeneralSettings::class));
        View::share('layoutSettings', app(LayoutSettings::class));
    }
}
