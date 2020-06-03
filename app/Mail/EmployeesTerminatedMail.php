<?php

namespace App\Mail;

use App\Termination;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeesTerminatedMail extends EmployeesBaseMail
{
    use Queueable;
    use SerializesModels;
    /**
     * Create a new message instance.
     */
    public function __construct(int $months)
    {
        $this->months = (int) $months;

        $this->markdown = 'emails.employees-terminated';

        $months = $months + 1;
        $this->title = "Employees Terminated Last " . $months . " Months";

        $this->employees = $this->getEmployees();
    }

    protected function getEmployees()
    {
        $startOfMonth = Carbon::now()->subMonths($this->months)->startOfMonth();

        return Termination::orderBy('termination_date', 'DESC')
            ->where('termination_date', '>=', $startOfMonth)
            ->with(['terminationType', 'terminationReason', 'employee' => function ($query) {
                return $query->with('site');
            }])
            ->get();
    }
}
