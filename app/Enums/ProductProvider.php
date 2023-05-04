<?php

namespace App\Enums;

enum ProductProvider
{
    case ENVATO;
    case SELF_HOSTED;

    public function label(): string
    {
        return match ($this) {
            self::ENVATO => trans('Envato Market'),
            self::SELF_HOSTED => trans('Self Hosted'),
        };
    }
}
