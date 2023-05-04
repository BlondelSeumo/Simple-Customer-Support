@component('mail::message')
{{ __('Hi :user,', ['user' => $ticket->user->name]) }}

{{ __(':agent from :company here. Hope you’re doing well!', ['agent' => $agent->name, 'company' => $generalSettings->site_name ?? config('app.name')]) }}

{{ __('You\'ve reported a problem with :subject on :date. As promised, I’m circling back to tell you that it has been successfully resolved.', ['subject' => $ticket->subject, 'date' => $ticket->created_at->toFormattedDateString()]) }}

{{ __('The problem turned out to be more complex than we thought, so it took a little bit longer to get it fixed. But everything should be fine now.') }}

{{ __('If you have any more questions or come across any other issues, please submit a new ticket and I\'ll be happy to help.') }}

{{ __('Have a great day,') }}<br>
{{ $agent->name }}<br>
{{ $generalSettings->site_name ?? config('app.name') }}
@endcomponent
