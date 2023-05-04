<?php

namespace App\Http\Livewire\User\Ticket;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketList extends Component
{
    use WithPagination;

    public function getUserProperty()
    {
        return \Auth::user();
    }

    public function getTicketsProperty()
    {
        return Ticket::query()
            ->with('product')
            ->where('user_id', $this->user->id)
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.user.ticket.ticket-list')->layout('layouts.guest');
    }
}
