<?php

namespace App\Listeners;

use App\Events\EmployeesUpdates;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyEmployeesHired
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
     * @param  EmployeesUpdates  $event
     * @return void
     */
    public function handle(EmployeesUpdates $event)
    {
        //
    }
}
