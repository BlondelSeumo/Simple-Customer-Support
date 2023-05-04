<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class NotificationSettings extends Settings
{
    public bool $send_ticket_confirmation_to_admins = true;
    public bool $send_ticket_confirmation_to_product_managers = true;
    public bool $send_ticket_confirmation_to_ticket_assignees = true;

    public static function group(): string
    {
        return 'notification';
    }
}
