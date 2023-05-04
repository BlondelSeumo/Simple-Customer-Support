<?php

namespace App\Http\Livewire\Setup;

use Illuminate\Validation\Rules\Password;
use Spatie\LivewireWizard\Components\StepComponent;

class AdministratorAccountStep extends StepComponent
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:agents,email',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function save()
    {
        $this->validate();
        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.setup.administrator-account-step');
    }
}
