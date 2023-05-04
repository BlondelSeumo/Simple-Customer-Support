<?php

namespace App\Http\Livewire\Agent\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    public $remember_me = false;

    protected $rules = [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
        'remember_me' => ['sometimes', 'bool'],
    ];

    public function login()
    {
        $this->validate();

        if (! Auth::guard('agent')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            return $this->addError('email', trans('auth.failed'));
        }

        $this->redirect(RouteServiceProvider::AGENT_HOME);
    }

    public function render()
    {
        return view('livewire.agent.auth.login')->layout('layouts.blank');
    }
}
