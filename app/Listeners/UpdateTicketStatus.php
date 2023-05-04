<?php

namespace App\Listeners;

use App\Enums\TicketStatus;
use App\Events\CommentCreated;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTicketStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentCreated  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        $ticket = Ticket::query()->findOrFail($event->comment->commentable_id);

        if ($event->comment->commentator instanceof User) {
            $ticket->update([
                'status' => TicketStatus::OPEN,
            ]);
        } else {
            $ticket->update([
                'status' => TicketStatus::PENDING,
            ]);
        }
    }
}
