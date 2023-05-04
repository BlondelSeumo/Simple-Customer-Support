<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $setup_finished;
    public string $purchase_code;
    public string $site_name;
    public string $site_description;
    public string $logo_path;
    public string $favicon_path;
    public string $banner_path;
    public string $contact_email;
    public string $contact_phone;
    public string $contact_address;
    public bool $cookie_consent_enabled;
    public string $cookie_consent_message;
    public string $cookie_consent_agree;
    public bool $enable_user_registration;
    public bool $recaptcha_enabled;
    public string $recaptcha_site_key;
    public string $recaptcha_secret_key;
    public bool $announcement_enabled;
    public string $announcement_message;
    public string $announcement_link;
    public string $announcement_link_text;
    
    public static function group(): string
    {
        return 'general';
    }
}
