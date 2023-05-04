<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class SignUpSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.enable_user_registration', true);
    }

    public function down()
    {
        $this->migrator->delete('general.enable_user_registration');
    }
}
