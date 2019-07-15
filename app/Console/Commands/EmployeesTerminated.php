<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Termination;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeesTerminatedMail;

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
        $months = $this->option('months');
        $startOfMonth = Carbon::now()->subMonths($months)->startOfMonth();

        $terminations = Termination::orderBy('termination_date', 'DESC')
            ->where('termination_date', '>=', $startOfMonth)
            ->with(['terminationType', 'terminationReason', 'employee' => function ($query) {
                return $query->with('site');
            }])
            ->get();

        Mail::send(new EmployeesTerminatedMail($terminations, $months));
    }
}
