<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TicketSettings extends Settings
{
    public bool $allow_assignment_to_admins;
    public bool $allow_agent_to_assign_ticket;
    public bool $allow_agent_to_resign_ticket;
    public bool $allow_agent_to_see_license_code;
    public bool $hide_selection_if_only_one_product_available;
    public bool $disable_comment_if_ticket_closed;
    public bool $disable_comment_if_support_expired;
    public bool $auto_assignment_enabled;
    public bool $auto_assignment_use_random_agent;
    public int $max_comments_per_page;
    public int $max_attachment_upload_size;
    public int $max_image_upload_size;

    public static function group(): string
    {
        return 'ticket';
    }
}
