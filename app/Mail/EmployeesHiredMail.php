<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeesHiredMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public $employees;

    /**
     * Create a new message instance.
     */
    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('yjorge@eccocorpbpo.com')
            ->subject('Employees Hired Last 2 Months')
            ->markdown('emails.employees-hired');
    }
}
