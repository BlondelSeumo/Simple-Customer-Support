<?php

namespace App\Http\Livewire\Setup;

use Spatie\LivewireWizard\Components\WizardComponent;

class SetupWizard extends WizardComponent
{
    public function steps(): array
    {
        return [
            GeneralInformationStep::class,
            AdministratorAccountStep::class,
            FinalizeSetupStep::class,
        ];
    }
}
