<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReportEmployeesHired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:employees-hired {--month=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email with all the since the given month';

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
        Log::notice('Email Sent');
        //File::put(storage_path('/app/files/employees-hired-'.Carbon::now()->format('H-i-s').'.txt'), 'Employees');
        $this->info('Email sent to yismen.jorge@gmail.com');
    }
}
