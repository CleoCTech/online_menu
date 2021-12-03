<?php

namespace App\Providers;

use App\Events\DishCreatedEvent;
use App\Events\ResPasswordResetEvent;
use App\Listeners\ResPasswordResetListener;
use App\Listeners\StoreFilesListener;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DishCreatedEvent::class => [
            StoreFilesListener::class,
        ],
        ResPasswordResetEvent::class => [
            ResPasswordResetListener::class,
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
