<?php

namespace App\Http\Livewire\Agent\Setting;

use App\Rules\Delimited;
use App\Settings\LayoutSettings;
use Livewire\Component;

class LayoutSettingsManager extends Component
{
    public $homepageMetaTitle;
    public $homepageMetaDescription;
    public $homepageFAQTitle;
    public $homepageFAQDescription;
    public $homepageFAQItems = [];
    public $homepageSuggestedSearches = [];

    protected $messages = [
        'homepageFAQItems.*.question.required' => 'The question field is required.',
        'homepageFAQItems.*.answer.required' => 'The answer field is required.',
    ];

    public function mount()
    {
        abort_if(! auth()->user()->is_admin, 403);

        $this->homepageMetaTitle = $this->layoutSettings->homepage_meta_title;
        $this->homepageMetaDescription = $this->layoutSettings->homepage_meta_description;
        $this->homepageFAQTitle = $this->layoutSettings->homepage_faq_title;
        $this->homepageFAQDescription = $this->layoutSettings->homepage_faq_description;
        $this->homepageFAQItems = $this->layoutSettings->homepage_faq_items;
        $this->homepageSuggestedSearches = $this->layoutSettings->homepage_suggested_searches;
    }

    public function updatedHomepageSuggestedSearches($value)
    {
        $this->homepageSuggestedSearches = ! $value ? [] : explode(',', $value);
    }

    public function addHomepageFAQItem()
    {
        $this->homepageFAQItems[] = [
            'question' => '',
            'answer' => '',
        ];
    }

    public function deleteHomepageFAQItem($item)
    {
        array_splice($this->homepageFAQItems, $item, 1);
    }

    public function saveHomepageInformation()
    {
        $this->validate([
            'homepageMetaTitle' => 'required|string',
            'homepageMetaDescription' => 'required|string',
        ]);
        $this->layoutSettings->homepage_meta_title = $this->homepageMetaTitle;
        $this->layoutSettings->homepage_meta_description = $this->homepageMetaDescription;
        $this->layoutSettings->save();
        $this->emitSelf('home-page-information-saved');
    }

    public function saveHomepageSuggestedSearches()
    {
        $this->validate([
            'homepageSuggestedSearches.*' => ['nullable', new Delimited('string')],
        ]);
        $this->layoutSettings->homepage_suggested_searches = $this->homepageSuggestedSearches;
        $this->layoutSettings->save();
        $this->emitSelf('home-page-suggested-searches-saved');
    }

    public function saveHomepageFrequentlyAskedQuestions()
    {
        $this->validate([
            'homepageFAQTitle' => 'required|string',
            'homepageFAQDescription' => 'required|string',
            'homepageFAQItems' => 'array',
            'homepageFAQItems.*.question' => 'required|string',
            'homepageFAQItems.*.answer' => 'required|string',
        ]);
        $this->layoutSettings->homepage_faq_title = $this->homepageFAQTitle;
        $this->layoutSettings->homepage_faq_description = $this->homepageFAQDescription;
        $this->layoutSettings->homepage_faq_items = $this->homepageFAQItems;
        $this->layoutSettings->save();
        $this->emitSelf('home-page-faq-saved');
    }

    public function getLayoutSettingsProperty()
    {
        return app(LayoutSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.setting.layout-settings-manager');
    }
}
