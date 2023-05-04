<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LayoutSettings extends Settings
{
    public string $homepage_meta_title;
    public string $homepage_meta_description;
    public string $homepage_faq_title;
    public string $homepage_faq_description;
    public array $homepage_faq_items;
    public array $homepage_suggested_searches;

    public static function group(): string
    {
        return 'layout';
    }
}
