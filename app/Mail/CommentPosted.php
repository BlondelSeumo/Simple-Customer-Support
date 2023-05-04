<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentPosted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(trans('[Ticket #:ticketId]: :commentatorName has replied to your ticket', [
                'ticketId' => $this->comment->commentable_id,
                'commentatorName' => $this->comment->commentator->name,
            ]))
            ->markdown('emails.comments.posted', [
                'url' => $this->comment->commentator instanceof User ? route('agent.tickets.details', $this->comment->commentable_id) : route('user.tickets.details', $this->comment->commentable_id),
            ]);
    }
}
