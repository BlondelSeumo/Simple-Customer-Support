<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class LayoutSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('layout.homepage_meta_title', 'Customer Support Software for Freelancers and SMBs');
        $this->migrator->add('layout.homepage_meta_description', 'Built on top of the Laravel framework, Ticksify helps you set up a customer support center in a prompt.');
        $this->migrator->add('layout.homepage_faq_title', 'Frequently asked questions');
        $this->migrator->add('layout.homepage_faq_description', 'Below you will find answers to the questions we get asked the most about our products.');
        $this->migrator->add('layout.homepage_faq_items', []);
        $this->migrator->add('layout.homepage_suggested_searches', []);
    }

    public function down()
    {
        $this->migrator->delete('layout.homepage_meta_title');
        $this->migrator->delete('layout.homepage_meta_description');
        $this->migrator->delete('layout.homepage_faq_title');
        $this->migrator->delete('layout.homepage_faq_description');
        $this->migrator->delete('layout.homepage_faq_items');
        $this->migrator->delete('layout.homepage_suggested_searches');
    }
}
