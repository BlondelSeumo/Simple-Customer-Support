<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class NotificationSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('notification.send_ticket_confirmation_to_admins', true);
        $this->migrator->add('notification.send_ticket_confirmation_to_product_managers', true);
        $this->migrator->add('notification.send_ticket_confirmation_to_ticket_assignees', true);
    }

    public function down(): void
    {
        $this->migrator->delete('notification.send_ticket_confirmation_to_admins');
        $this->migrator->delete('notification.send_ticket_confirmation_to_product_managers');
        $this->migrator->delete('notification.send_ticket_confirmation_to_ticket_assignees');
    }
}
