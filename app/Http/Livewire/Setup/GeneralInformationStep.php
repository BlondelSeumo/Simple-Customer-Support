<?php

namespace App\Http\Livewire\Setup;

use App\Settings\GeneralSettings;
use Spatie\LivewireWizard\Components\StepComponent;

class GeneralInformationStep extends StepComponent
{
    public $siteName;
    public $siteDescription;

    protected $rules = [
        'siteName' => 'required|string',
        'siteDescription' => 'required|string',
    ];

    public function mount()
    {
        $this->siteName = $this->generalSettings->site_name;
        $this->siteDescription = $this->generalSettings->site_description;
    }

    public function save()
    {
        $this->validate();
        $this->nextStep();
    }

    public function getGeneralSettingsProperty()
    {
        return app(GeneralSettings::class);
    }

    public function render()
    {
        return view('livewire.setup.general-information-step');
    }
}
