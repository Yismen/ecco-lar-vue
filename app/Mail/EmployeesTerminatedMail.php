<?php

namespace App\Mail;

use App\Termination;
use Carbon\Carbon;
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
    public function __construct($months)
    {
        $this->months = (int) $months;

        $this->terminations = $this->getTerminations();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $months = $this->months  + 1;
        
        return $this->to('yjorge@eccocorpbpo.com')
            ->subject('Employees Terminated Last ' . $months .' Months')
            ->markdown('emails.employees-terminated');
    }

    protected function getTerminations()
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
