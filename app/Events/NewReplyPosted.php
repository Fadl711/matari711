<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewReplyPosted implements ShouldBroadcast
{
    public $reply;

    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('comments.' . $this->reply->comment_id);
    }
}
