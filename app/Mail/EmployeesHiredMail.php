<?php

namespace App\Mail;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeesHiredMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $months;
    
    public $employees;

    /**
     * Create a new message instance.
     */
    public function __construct($months)
    {
        $this->months = (int) $months;

        $this->employees = $this->getEmployees();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $months = $this->months + 1;
        
        return $this->to('yjorge@eccocorpbpo.com')
            ->subject('Employees Hired Last ' . $months . ' Months')
            ->markdown('emails.employees-hired');
    }

    protected function getEmployees()
    {
        return Employee::whereDate('hire_date', '>=', Carbon::now()->subMonths($this->months)->startOfMonth())
            ->orderBy('hire_date', 'DESC')
            ->orderBy('first_name')
            ->orderBy('second_first_name')
            ->orderBy('last_name')
            ->with(['termination', 'supervisor', 'site', 'project'])
            ->with(['position' => function ($query) {
                return $query->with(['department', 'payment_type']);
            }])
            ->get();
    }
}
