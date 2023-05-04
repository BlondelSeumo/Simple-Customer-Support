<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class EnvatoSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('envato.token_enabled', false);
        $this->migrator->add('envato.oauth_enabled', false);
        $this->migrator->add('envato.account_token', '');
        $this->migrator->add('envato.account_email', '');
        $this->migrator->add('envato.account_username', '');
        $this->migrator->add('envato.oauth_client_id', '');
        $this->migrator->add('envato.oauth_client_secret', '');
    }

    public function down()
    {
        $this->migrator->delete('envato.token_enabled');
        $this->migrator->delete('envato.oauth_enabled');
        $this->migrator->delete('envato.account_token');
        $this->migrator->delete('envato.account_email');
        $this->migrator->delete('envato.account_username');
        $this->migrator->delete('envato.oauth_client_id');
        $this->migrator->delete('envato.oauth_client_secret');
    }
}
