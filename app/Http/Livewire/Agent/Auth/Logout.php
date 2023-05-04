<?php

namespace App\Http\Livewire\Agent\Auth;

use App\Providers\RouteServiceProvider;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        \Auth::guard('agent')->logout();

        session()->forget('url.intended');
        
        $this->redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.agent.auth.logout')->layout('layouts.blank');
    }
}
