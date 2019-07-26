<?php

namespace App\Listeners;

use App\Employee;
use App\Events\EmployeeCreated;

class CreateEmployeeSchedule
{
    protected $employee;

    /**
     * Create the event listener.
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Handle the event.
     *
     * @param EmployeeCreated $event
     */
    public function handle(EmployeeCreated $event)
    {
        dd('Listener', $event);
    }
}
