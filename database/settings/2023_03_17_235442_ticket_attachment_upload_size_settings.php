<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class TicketAttachmentUploadSizeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ticket.max_attachment_upload_size', 10);
    }

    public function down(): void
    {
        $this->migrator->delete('ticket.max_attachment_upload_size');
    }
}
