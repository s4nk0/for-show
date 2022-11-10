<?php

namespace App\Providers;

use App\Events\NewCallBackSubmitted;
use App\Events\NewOrderCreated;
use App\Listeners\NewCallBackSubmitListener;
use App\Listeners\NewOrderListener;
use App\Notifications\NewOrderCreatedNotification;
use App\Notifications\NewOrderNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            \SocialiteProviders\Google\GoogleExtendSocialite::class.'@handle',
            \SocialiteProviders\Facebook\FacebookExtendSocialite::class.'@handle',
        ],
        NewOrderCreated::class=>[
            NewOrderListener::class
        ],
        NewCallBackSubmitted::class=>[
            NewCallBackSubmitListener::class
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
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
}
