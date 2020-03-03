<?php

namespace App\Console\Commands;

use App\Exports\Capillus\CapillusLeadsExport;
use App\Mail\Capillus\CapillusAgentCallDataDumpEmail;
use App\Mail\Capillus\CapillusLeadsReportMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel as ExcelExcel;

class CapillusLeadsCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-send-daily-leads-report {--from=default} {--date=default} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus - send daily call data dump report';

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
            $date = $this->option('date') == 'default' ?
                Carbon::now()->subDay() :
                Carbon::parse($this->option('date'));

            $from = $this->option('from') == 'default' ?
                $date :
                Carbon::parse($this->option('from'));

            $instance = $date->format('Y-m-d');
            $file_name = "Kipany Lead {$instance} ECC.csv";

            Excel::store(
                new CapillusLeadsExport([
                    'date_from' => $from->format('Y-m-d'),
                    'date_to' => $date->format('Y-m-d'),
                ]), // Create file
                $file_name, // file name
                'kipany-sftp', // disk,
                ExcelExcel::CSV
            );

            // Mail::send(
            //      new CapillusLeadsReportMail(
            //          $this->distroList(), 
            //          $file_name, 
            //          "Kipany-Capillus - ECCO Leads File
            //      )
            // );
    
            $this->info("Kipany-Capillus - Leads Report Sent!");
        } catch (\Throwable $th) {
            Log::error($th);

            $this->error("Something went wrong");
        }
    }
}
