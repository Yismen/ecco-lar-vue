<?php

namespace App\Listeners;

use App\Events\EmployeeCreate;

class SemdEmailToHumanResources
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
     * @param  EmployeeCreate  $event
     * @return void
     */
    public function handle(EmployeeCreate $event)
    {
    }
}
