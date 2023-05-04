<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class ReCaptchaSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.recaptcha_enabled', false);
        $this->migrator->add('general.recaptcha_site_key', '');
        $this->migrator->add('general.recaptcha_secret_key', '');
    }

    public function down(): void
    {
        $this->migrator->delete('general.recaptcha_enabled');
        $this->migrator->delete('general.recaptcha_site_key');
        $this->migrator->delete('general.recaptcha_secret_key');
    }
}
