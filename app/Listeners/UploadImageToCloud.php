<?php

namespace App\Listeners;

use App\Events\ImageUploaded;
use App\Jobs\ImageReducer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadImageToCloud
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
     * @param  ImageUploaded  $event
     * @return void
     */
    public function handle(ImageUploaded $event)
    {
        // Send image to the aws cloud

        // Call to image reducer
    }
}
