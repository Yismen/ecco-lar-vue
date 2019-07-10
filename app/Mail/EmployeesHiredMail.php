<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeesHiredMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $employees;
    public $months;

    /**
     * Create a new message instance.
     */
    public function __construct($employees, $months)
    {
        $this->employees = $employees;
        $this->months = $months;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('yjorge@eccocorpbpo.com')
            ->subject('Employees Hired Last '.$this->months.' Months')
            ->markdown('emails.employees-hired');
    }
}
