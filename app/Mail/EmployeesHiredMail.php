<?php

namespace App\Mail;

use App\Employee;
use Carbon\Carbon;

class EmployeesHiredMail extends EmployeesBaseMail
{
    public function __construct(int $months)
    {
        $this->months = (int) $months;

        $this->markdown = 'emails.employees-hired';

        $months = $months + 1;
        $this->title = "Employees Hired Last " . $months . " Months";

        $this->employees = $this->getEmployees();
    }

    protected function getEmployees()
    {
        return Employee::whereDate('hire_date', '>=', Carbon::now()->subMonths($this->months)->startOfMonth())
            ->orderBy('hire_date', 'DESC')
            ->orderBy('site_id')
            ->sorted()
            ->with(['termination', 'supervisor', 'site', 'project'])
            ->with(['position' => function ($query) {
                return $query->with(['department', 'payment_type']);
            }])
            ->get();
    }
}
