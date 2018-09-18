<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ReportEmployeesHired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:hired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email with all the employees hired the previous day';

    /**
     * Create a new command instance.
     *
     * @return void
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
        File::put(storage_path('files/employees' . Carbon::now()->format('H-i-s') . '.txt'), 'Employees');
        $this->info('Email sent to the users');
    }
}
