<?php

namespace App\Console\Commands;

use App\Mail\EmployeesHiredMail;
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

        Mail::send(new EmployeesHiredMail($months));

        $this->info("Employees hired email sent!");
    }
}
