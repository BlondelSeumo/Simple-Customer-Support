<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class TicketSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ticket.allow_assignment_to_admins', false);
        $this->migrator->add('ticket.allow_agent_to_assign_ticket', false);
        $this->migrator->add('ticket.allow_agent_to_resign_ticket', false);
        $this->migrator->add('ticket.allow_agent_to_see_license_code', false);
        $this->migrator->add('ticket.hide_selection_if_only_one_product_available', true);
        $this->migrator->add('ticket.disable_comment_if_ticket_closed', true);
        $this->migrator->add('ticket.disable_comment_if_support_expired', true);
    }

    public function down()
    {
        $this->migrator->delete('ticket.allow_assignment_to_admins');
        $this->migrator->delete('ticket.allow_agent_to_assign_ticket');
        $this->migrator->delete('ticket.allow_agent_to_resign_ticket');
        $this->migrator->delete('ticket.allow_agent_to_see_license_code');
        $this->migrator->delete('ticket.hide_selection_if_only_one_product_available');
        $this->migrator->delete('ticket.disable_comment_if_ticket_closed');
        $this->migrator->delete('ticket.disable_comment_if_support_expired');
    }
}
