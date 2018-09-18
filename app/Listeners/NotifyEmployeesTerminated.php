<?php

namespace App\Listeners;

use App\Events\EmployeesUpdates;

class NotifyEmployeesTerminated
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
