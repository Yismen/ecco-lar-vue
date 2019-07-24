<?php

namespace App\Events;

use App\Employee;
use Illuminate\Queue\SerializesModels;

class EmployeeCreated extends Event
{
    private $employee;

    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
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
