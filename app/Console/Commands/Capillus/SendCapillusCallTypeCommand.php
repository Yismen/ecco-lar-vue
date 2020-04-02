<?php

namespace App\Console\Commands\Capillus;

use App\Exports\Capillus\CapillusCallTypeExport;
use App\Mail\Capillus\CapillusCallTypeReportMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class SendCapillusCallTypeCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-send-calls-type-report {--date=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus - send daily call type report';

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
            $file_name = "Kipany-Capillus - Fax Calls Report {$instance}.xlsx";

            $date = $this->option('date') == 'default' ?
                Carbon::now()->subDay() :
                Carbon::parse($this->option('date'));
            
            Excel::store(new CapillusCallTypeExport($date), $file_name);

            Mail::send(
                new CapillusCallTypeReportMail($this->distroList(), $file_name, "Kipany-Capillus - Call Type Report")
            );
    
            $this->info("Kipany-Capillus - Calls Type Report sent!");
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            $this->error("Something went wrong");
        }
    }
}
