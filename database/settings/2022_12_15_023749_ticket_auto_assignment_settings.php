<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class TicketAutoAssignmentSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ticket.auto_assignment_enabled', false);
        $this->migrator->add('ticket.auto_assignment_use_random_agent', false);
    }

    public function down(): void
    {
        $this->migrator->delete('ticket.auto_assignment_enabled');
        $this->migrator->delete('ticket.auto_assignment_use_random_agent');
    }
}
