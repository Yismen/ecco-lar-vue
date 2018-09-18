<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class EmployeeCreated extends Event
{
    private $employee;
    private $request;

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($employee, $request)
    {
        $this->employee = $employee;
        $this->request = $request;
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
