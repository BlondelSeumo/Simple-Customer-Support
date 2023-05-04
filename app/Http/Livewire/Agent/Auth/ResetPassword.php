<?php

namespace App\Http\Livewire\Agent\Auth;

use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Str;

class ResetPassword extends Component
{
    public $token;

    public $email;

    public $password;

    public $password_confirmation;

    protected $queryString = ['email'];

    protected $rules = [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];

    public function mount($token)
    {
        $this->token = $token;
    }

    public function submit()
    {
        $this->validate();

        $status = Password::broker('agents')
            ->reset([
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ], function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('agent.login')->with('status', trans($status))
            : $this->addError('email', trans($status));
    }

    public function render()
    {
        return view('livewire.agent.auth.reset-password')->layout('layouts.blank');
    }
}
