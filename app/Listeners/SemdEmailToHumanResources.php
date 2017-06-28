<?php

namespace App\Listeners;

use App\Events\EmployeeCreate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
