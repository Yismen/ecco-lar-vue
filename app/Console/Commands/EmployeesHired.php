<?php

namespace App\Console\Commands;

use App\Employee;
use App\Mail\EmployeesHiredMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmployeesHired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:employees-hired {--months=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email with all the employees hired since the given month';

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
        $months = $this->option('months');

        $employees = Employee::whereDate('hire_date', '>=', Carbon::now()->subMonths($months)->startOfMonth())
            ->orderBy('hire_date', 'DESC')
            ->orderBy('first_name')
            ->orderBy('second_first_name')
            ->orderBy('last_name')
            ->with(['termination', 'supervisor', 'site', 'project'])
            ->with(['position' => function ($query) {
                return $query->with(['department', 'payment_type']);
            }])
            ->get();

        Mail::send(new EmployeesHiredMail($employees, $months));
    }
}
