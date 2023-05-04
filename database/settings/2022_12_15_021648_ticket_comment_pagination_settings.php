<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class TicketCommentPaginationSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ticket.max_comments_per_page', 10);
    }

    public function down(): void
    {
        $this->migrator->delete('ticket.max_comments_per_page');
    }
}
