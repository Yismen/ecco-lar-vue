<?php

namespace App\Listeners;

use App\Events\MessageCreaed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserOfANewMessage
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
     * @param  MessageCreaed  $event
     * @return void
     */
    public function handle(MessageCreaed $event)
    {
        Log::info('user {$event->sender->name} sent a new to message to {$vent->recipient->name}');
    }
}
