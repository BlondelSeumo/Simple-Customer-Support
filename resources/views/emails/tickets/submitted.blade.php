@component('mail::message')
{{ __('This is an automated message to let you know that a new ticket has been submitted to your system.') }}

@component('mail::panel')
{{ __('Ticket: #:ticket', ['ticket' => $ticket->id]) }}

{{ __('Subject: :subject', ['subject' => $ticket->subject]) }}

{{ __('Category: :category', ['category' => $ticket->category->name]) }}

{{ __('Product: :product', ['product' => $ticket->product->name]) }}

{{ __('Submitted by: :name', ['name' => $ticket->user->name]) }}

{{ __('Submitted on: :date', ['date' => $ticket->created_at->format('m/d/Y H:i:s')]) }}
@endcomponent

{{ __('You can view this ticket by clicking the button below.') }}

@component('mail::button', ['url' => $url])
{{ __('View Ticket Details') }}
@endcomponent

{{ __('Please take your time to solve the issue as soon as possible.') }}

{{ __('Best regards,') }}<br>
{{ $generalSettings->site_name ?? config('app.name') }}

@endcomponent
