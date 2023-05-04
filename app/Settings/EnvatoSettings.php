<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EnvatoSettings extends Settings
{
    public bool $token_enabled;
    public bool $oauth_enabled;
    public string $account_token;
    public string $account_email;
    public string $account_username;
    public string $oauth_client_id;
    public string $oauth_client_secret;

    public static function group(): string
    {
        return 'envato';
    }
}
