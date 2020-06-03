<?php

namespace App\Mail;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class EmployeesBaseMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $months;

    protected $markdown;

    public $title;

    public $employees;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('yjorge@eccocorpbpo.com')
            ->subject($this->title)
            ->markdown($this->markdown);
    }

    abstract protected function getEmployees();
}
