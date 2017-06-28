<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCreaed extends Event
{
    private $sender;
    private $recipient;

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sender, $recipient)
    {        
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
