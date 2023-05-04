<?php

namespace App\Listeners;

use App\Enums\TicketStatus;
use App\Events\TicketStatusUpdated;
use App\Mail\TicketResolved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTicketStatusUpdatesNotification
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
     * @param  \App\Events\TicketStatusUpdated  $event
     * @return void
     */
    public function handle(TicketStatusUpdated $event)
    {
        if ($event->ticket->status === TicketStatus::SOLVED) {
            // Send notification to customer
            Mail::to($event->ticket->user->email)->send(new TicketResolved($event->agent, $event->ticket));
        }
    }
}
