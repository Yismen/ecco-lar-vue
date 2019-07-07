<?php

namespace App\Console\Commands;

use App\Employee;
use App\Mail\EmployeesTerminatedMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmployeesTerminated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:employees-terminated {--months=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email with all the employees terminated since the given month';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startOfMonth = Carbon::now()->subMonths($this->option('months'))->startOfMonth();

        $employees = Employee::with('site')
            ->with(['termination' => function ($query) {
                return $query->orderBy('termination_date')
                        ->with(['terminationType', 'terminationReason']);
            }])
            ->whereHas('termination', function ($query) use ($startOfMonth) {
                return $query->whereDate('termination_date', '>=', $startOfMonth)
                        ->orderBy('termination_date')
                        ->with(['terminationType', 'terminationReason']);
            })
            ->orderBy('first_name')
            ->orderBy('second_first_name')
            ->orderBy('last_name')
            ->get();

        Mail::send(new EmployeesTerminatedMail($employees));
    }
}
