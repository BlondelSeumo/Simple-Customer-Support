<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Mail\CommentPosted;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketResponded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Notification;

class SendCommentNotification
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
        if ($event->comment->commentator instanceof User) {
            // send notification to all assigned agents
            $assignees = Ticket::with('assignees')->findOrFail($event->comment->commentable_id)->assignees;

            Notification::send($assignees, new TicketResponded($event->comment->commentable));

            foreach ($assignees as $recipient) {
                Mail::to($recipient->email)->send(new CommentPosted($event->comment));
            }
        } else {
            // send notification to the ticket owner
            $user = Ticket::with('user')->findOrFail($event->comment->commentable_id)->user;
            Mail::to($user->email)->send(new CommentPosted($event->comment));
        }
    }
}
