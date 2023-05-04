<?php

namespace App\Mail;

use App\Models\Agent;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketResolved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $agent;
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agent $agent, Ticket $ticket)
    {
        $this->agent = $agent;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(trans('[Ticket #:ticketId]: Your issue has been successfully resolved', [
                'ticketId' => $this->ticket->id,
            ]))
            ->markdown('emails.tickets.resolved');
    }
}
