<?php

namespace App\Enums;

enum TicketPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case CRITICAL = 'critical';

    public function label(): string
    {
        return match ($this) {
            self::LOW => trans('Low'),
            self::MEDIUM => trans('Medium'),
            self::HIGH => trans('High'),
            self::CRITICAL => trans('Critical'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::LOW => '#65a30d', // lime-600
            self::MEDIUM => '#94a3b8', // slate-600
            self::HIGH, self::CRITICAL => '#dc2626', // red-600
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::LOW => 'heroicon-m-arrow-down',
            self::MEDIUM => 'circle-mini',
            self::HIGH => 'heroicon-m-arrow-up',
            self::CRITICAL => 'heroicon-m-chevron-double-up',
        };
    }
}
