<?php

namespace App\Listeners;

use App\Events\ImageUploaded;
use App\Notifications\ImageUploadNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;

class SendUserNotification
{
    use notifiable;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  ImageUploaded  $event
     * @return void
     */
    public function handle(ImageUploaded $event)
    {
        // Notify user that his image has been uploaded to cloud
        $event->user->notify( new ImageUploadNotification() );
    }
}
