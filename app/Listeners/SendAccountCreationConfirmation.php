<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use App\Notifications\AccountCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendAccountCreationConfirmation
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
     * @param  AccountCreated  $event
     * @return void
     */
    public function handle(AccountCreated $event)
    {
        // Send notification about account creation
        $event->user->notify( new AccountCreatedNotification());
    }
}
