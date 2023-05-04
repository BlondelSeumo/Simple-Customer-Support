<?php

namespace App\Enums;

enum TicketStatus: string
{
    case OPEN = 'open';
    case PENDING = 'pending';
    case ON_HOLD = 'on_hold';
    case SOLVED = 'solved';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => trans('Open'),
            self::PENDING => trans('Pending'),
            self::ON_HOLD => trans('On Hold'),
            self::SOLVED => trans('Solved'),
            self::CLOSED => trans('Closed'),
        };
    }
}
