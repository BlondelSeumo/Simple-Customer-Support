<?php

namespace App\Http\Livewire\Agent\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|string|email',
    ];

    public function submit()
    {
        $this->validate();

        $status = Password::broker('agents')->sendResetLink(['email' => $this->email]);

        $status === Password::RESET_LINK_SENT
            ? session()->flash('status', trans($status))
            : $this->addError('email', trans($status));
    }

    public function render()
    {
        return view('livewire.agent.auth.forgot-password')->layout('layouts.blank');
    }
}
