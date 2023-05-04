@component('mail::message')
{{ __('Hi :name,', ['name' => $ticket->user->name]) }}

{{ __('Thank you for reaching out. This is just a quick note to inform you that we received your message and have already started working on resolving your issue.') }}

@component('mail::button', ['url' => $url])
{{ __('View Your Ticket') }}
@endcomponent

{{ __('If you have any further questions or concerns, please let us know. We are available round-the-clock and always happy to help. Thanks for being a loyal :companyName customer.', ['companyName' => $generalSettings->site_name ?? config('app.name')]) }}

{{ __('Best regards,') }}<br>
{{ $generalSettings->site_name ?? config('app.name') }}

@endcomponent
