<?php

namespace App\Http\Livewire\Agent;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use Livewire\Component;

class OpenTicketDropdown extends Component
{
    public $openTicketRows = [];

    public function getOpenTicketsCountProperty(): int
    {
        return Ticket::query()
            ->whereHas('assignees', function ($query) {
                return $query->where('agent_id', \Auth::user()->id);
            })
            ->where('status', TicketStatus::OPEN)
            ->count();
    }

    public function loadOpenTickets(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->openTicketRows = Ticket::query()
            ->whereHas('assignees', function ($query) {
                return $query->where('agent_id', \Auth::user()->id);
            })
            ->where('status', TicketStatus::OPEN)
            ->get();
    }

    public function render()
    {
        return view('livewire.agent.open-ticket-dropdown');
    }
}
