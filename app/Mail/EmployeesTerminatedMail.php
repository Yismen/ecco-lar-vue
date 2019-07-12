<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeesTerminatedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $terminations;
    public $months;

    /**
     * Create a new message instance.
     */
    public function __construct($terminations, $months)
    {
        $this->terminations = $terminations;
        $this->months = (int) $months + 1;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('yjorge@eccocorpbpo.com')
            ->subject('Employees Terminated Last '.$this->months.' Months')
            ->markdown('emails.employees-terminated');
    }
}
