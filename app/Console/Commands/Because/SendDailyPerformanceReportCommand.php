<?php

namespace App\Console\Commands\Because;

use App\Exports\Because\BecausePerformanceExport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\Because\BecauseDailyPerformanceMail;
use Illuminate\Support\Facades\Mail;

class SendDailyPerformanceReportCommand extends Command
{
    use BecauseCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:because-send-daily-performance-report {--date=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Because - send daily performance report';

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
        try {
            $instance = Carbon::now()->format('Ymd_His');
            $file_name = "Because Daily Performance Report {$instance}.xlsx";
            
            $date = $this->option('date') == 'default' ?
            Carbon::now()->subDay() :
            Carbon::parse($this->option('date'));
            
            Excel::store(new BecausePerformanceExport($date), $file_name);

            Mail::send(
                new BecauseDailyPerformanceMail($this->distroList(), $file_name, "Kipany - Because Daily Performance Report")
            );
    
            $this->info("Because Daily Performance sent!");
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            $this->error("Something went wrong");
        }
    }
}
