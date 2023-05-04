<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AnnouncementSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.announcement_enabled', false);
        $this->migrator->add('general.announcement_message', '');
        $this->migrator->add('general.announcement_link', '');
        $this->migrator->add('general.announcement_link_text', '');
    }

    public function down(): void
    {
        $this->migrator->delete('general.announcement_enabled');
        $this->migrator->delete('general.announcement_message');
        $this->migrator->delete('general.announcement_link');
        $this->migrator->delete('general.announcement_link_text');
    }
}
