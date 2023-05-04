<?php

namespace App\Http\Livewire\Agent\Profile;

use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class PasswordForm extends Component
{
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->agent->password = \Hash::make($this->password);
        $this->agent->save();
        $this->reset('password', 'password_confirmation');
        $this->notify(trans('Your new password successfully saved.'));
    }

    public function getAgentProperty()
    {
        return \Auth::user();
    }

    public function render()
    {
        return view('livewire.agent.profile.password-form');
    }
}
