<?php

namespace App\Providers;

use App\Services\Envato\Client;
use App\Settings\EnvatoSettings;
use Illuminate\Support\ServiceProvider;

class EnvatoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            abstract: Client::class,
            concrete: function () {
                return new Client(
                    apiUrl: config('services.envato.api_url'),
                    userAgent: config('services.envato.user_agent'),
                );
            });
    }
}
