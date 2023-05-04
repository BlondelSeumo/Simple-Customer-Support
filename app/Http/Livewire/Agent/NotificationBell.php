<?php

namespace App\Http\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationBell extends Component
{
    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return <<<'blade'
            <a
                wire:poll.30000ms
                href="{{ route('agent.notifications') }}"
                class="relative bg-white p-1 rounded-full text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-slate-300 dark:hover:text-slate-200 dark:focus:ring-offset-slate-800"
                title="{{ trans_choice('{0} You have no new notifications|{1} You have :count notification|[2,*] You have :count notifications', $this->user->unreadNotifications->count()) }}"
            >
                @if($this->user->unreadNotifications->count())
                    <span class="absolute top-0.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-blue-400 ring-2 ring-white dark:ring-slate-800"></span>
                @endif
                <span class="sr-only">{{ __('Open notification page') }}</span>
                <x-heroicon-o-bell class="h-6 w-6" />
            </a>
        blade;
    }
}
