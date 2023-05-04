<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Password::defaults(function () {
            return Password::min(8);
        });

        ResetPassword::createUrlUsing(function ($user, string $token) {
            if ($user instanceof \App\Models\Agent) {
                return route('agent.reset-password', ['token' => $token, 'email' => $user->getEmailForPasswordReset()]);
            }
            return route('password.reset', ['token' => $token, 'email' => $user->getEmailForPasswordReset()]);
        });
    }
}
