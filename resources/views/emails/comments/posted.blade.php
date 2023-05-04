@component('mail::message')
{{ __('This is an automated message indicating that a comment has been posted on your ticket.') }}

@component('mail::panel')
{{ __('Ticket: #:ticket', ['ticket' => $comment->commentable->id]) }}

{{ __('Subject: :subject', ['subject' => $comment->commentable->subject]) }}
@endcomponent

{{ __('You can view this ticket by clicking the button below.') }}

@component('mail::button', ['url' => $url])
{{ __('View Comment') }}
@endcomponent

{{ __('Thanks,') }}<br>
{{ $generalSettings->site_name ?? config('app.name') }}
@endcomponent
