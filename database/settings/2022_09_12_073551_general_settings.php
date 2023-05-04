<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class GeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.setup_finished', false);
        $this->migrator->add('general.purchase_code', '');
        $this->migrator->add('general.site_name', config('app.name', 'Ticksify'));
        $this->migrator->add('general.site_description', 'Customer Support Software for Freelancers and SMBs');
        $this->migrator->add('general.logo_path', '');
        $this->migrator->add('general.favicon_path', '');
        $this->migrator->add('general.banner_path', '');
        $this->migrator->add('general.contact_email', '');
        $this->migrator->add('general.contact_phone', '');
        $this->migrator->add('general.contact_address', '');
        $this->migrator->add('general.cookie_consent_enabled', false);
        $this->migrator->add('general.cookie_consent_message', 'We uses cookies to ensure you get the best experience on our website.');
        $this->migrator->add('general.cookie_consent_agree', 'Allow cookies');
    }

    public function down(): void
    {
        $this->migrator->delete('general.setup_finished');
        $this->migrator->delete('general.purchase_code');
        $this->migrator->delete('general.site_name');
        $this->migrator->delete('general.site_description');
        $this->migrator->delete('general.logo_path');
        $this->migrator->delete('general.favicon_path');
        $this->migrator->delete('general.banner_path');
        $this->migrator->delete('general.contact_email');
        $this->migrator->delete('general.contact_phone');
        $this->migrator->delete('general.contact_address');
        $this->migrator->delete('general.cookie_consent_enabled');
        $this->migrator->delete('general.cookie_consent_message');
        $this->migrator->delete('general.cookie_consent_agree');
    }
}
