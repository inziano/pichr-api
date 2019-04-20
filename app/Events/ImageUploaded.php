<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\User\Entities\User;
class ImageUploaded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $filename;

    public $user;
    /**
     * The name of the queue on which to place the event.
     *
     * @var string
     */
    public $broadcastQueue = 'images';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $filename, $user )
    {
        //File name to be uploaded
        $this->filename = $filename;
        // User who owns the file
        $this->user = User::where('id', $user )->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // dd( new Channel('image-upload'));
        return [];
    }

    public function broadcastAs() {
        return 'image-uploaded';
    }

}
