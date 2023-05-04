<?php

namespace App\Http\Livewire\User\Ticket;

use App\Models\Ticket;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TicketDetails extends Component
{
    public Ticket $ticket;

    protected $listeners = ['comment-posted' => '$refresh'];

    public function mount()
    {
        abort_if(auth()->id() != $this->ticket->user_id, 403);

        $this->ticket->load([
            'media',
        ]);
    }

    public function downloadAttachment(Media $attachment): Media
    {
        return $attachment;
    }

    public function render()
    {
        return view('livewire.user.ticket.ticket-details')->layout('layouts.guest');
    }
}
