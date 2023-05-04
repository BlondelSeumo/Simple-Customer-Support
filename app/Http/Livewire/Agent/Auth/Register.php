<?php

namespace App\Http\Livewire\Agent\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules;
use Livewire\Component;

class Register extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
        ]);

        \Auth::guard('user')->login($user);

        $this->redirect(RouteServiceProvider::ADMIN_HOME);
    }

    public function render()
    {
        return view('livewire.agent.auth.register')->layout('layouts.blank');
    }
}
