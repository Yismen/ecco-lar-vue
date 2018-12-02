<?php

namespace App\Listeners;

use App\Events\EmployeeTerminated as Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeeTerminated
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
     * @param  EmployeeTerminated  $event
     * @return void
     */
    public function handle(Event $event)
    {
    }
}
