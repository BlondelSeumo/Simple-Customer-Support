<?php

namespace App\Http\Livewire\Setup;

use App\Models\Agent;
use App\Settings\GeneralSettings;
use Spatie\LivewireWizard\Components\StepComponent;

class FinalizeSetupStep extends StepComponent
{
    public $setupFinished = false;

    public function submit()
    {
        $this->saveGeneralSettings();
        $this->createAdminAccount();
        $this->makeSetupFinished();
        $this->setupFinished = true;
    }

    protected function saveGeneralSettings()
    {
        $this->generalSettings->site_name = $this->state()->forStep('general-information-step')['siteName'];
        $this->generalSettings->site_description = $this->state()->forStep('general-information-step')['siteDescription'];
        $this->generalSettings->save();
    }

    protected function createAdminAccount()
    {
        $admin = new Agent(['is_admin' => true]);
        $admin->name = $this->state()->forStep('administrator-account-step')['name'];
        $admin->email = $this->state()->forStep('administrator-account-step')['email'];
        $admin->password = bcrypt($this->state()->forStep('administrator-account-step')['password']);
        $admin->save();

        \Auth::guard('agent')->login($admin);
    }

    protected function makeSetupFinished()
    {
        $this->generalSettings->setup_finished = true;
        $this->generalSettings->save();
    }

    public function getGeneralSettingsProperty()
    {
        return app(GeneralSettings::class);
    }

    public function render()
    {
        return view('livewire.setup.finalize-setup-step', [
            'state' => $this->state()->all(),
        ]);
    }
}
