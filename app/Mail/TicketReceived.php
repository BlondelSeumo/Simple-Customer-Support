<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
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
            ->subject(trans('[Ticket #:ticketId]: :ticketSubject', [
                'ticketId' => $this->ticket->id,
                'ticketSubject' => $this->ticket->subject,
            ]))
            ->markdown('emails.tickets.received', [
                'url' => route('user.tickets.details', $this->ticket->id),
            ]);
    }
}
