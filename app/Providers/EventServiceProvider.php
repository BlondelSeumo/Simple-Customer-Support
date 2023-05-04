<?php

namespace App\Providers;

use App\Events\CommentCreated;
use App\Events\TicketCreated;
use App\Events\TicketStatusUpdated;
use App\Listeners\SendCommentNotification;
use App\Listeners\SendTicketConfirmation;
use App\Listeners\SendTicketStatusUpdatesNotification;
use App\Listeners\UpdateTicketStatus;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use SocialiteProviders\Envato\EnvatoExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SocialiteWasCalled::class => [
            EnvatoExtendSocialite::class . '@handle',
        ],
        TicketCreated::class => [
            SendTicketConfirmation::class,
        ],
        TicketStatusUpdated::class => [
            SendTicketStatusUpdatesNotification::class,
        ],
        CommentCreated::class => [
            SendCommentNotification::class,
            UpdateTicketStatus::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
