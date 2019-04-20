<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

class SendWelcomeNotification implements ShouldQueue
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event, Mailer $mailer)
    {
        $emailAddress = $event->email;

        // Send email to the user
        //Send email
        $mailer->send('emails.welcome',  ['email' => $emailAddress], function( $message ){
            $message->from('dev@pichr.com');
            $message->to( $emailAddress );
        });

    }
}
