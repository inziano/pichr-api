<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\ImageUploaded' => [
            'App\Listeners\SendUserNotification',
            'App\Listeners\UploadImageToCloud',
        ],
        'App\Events\UserCreated' => [
            'App\Listeners\SendWelcomeNotification',
        ],
        'App\Events\AccountCreated' => [
            'App\Listeners\SendAccountCreationConfirmation',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
