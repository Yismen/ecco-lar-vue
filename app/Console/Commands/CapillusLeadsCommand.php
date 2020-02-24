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
            $instance = Carbon::now()->format('Y-m-d_His');
            $file_name = "Kipany Lead {$instance} ECC.xlsx";

            $date = $this->option('date') == 'default' ?
                Carbon::now()->subDay() :
                Carbon::parse($this->option('date'));

            $from = $this->option('from') == 'default' ?
                $date :
                Carbon::parse($this->option('from'));

            Excel::store(new CapillusLeadsExport([
                'date_from' => $from->format('Y-m-d'),
                'date_to' => $date->format('Y-m-d'),
            ]), $file_name);

            Mail::send(
                new CapillusLeadsReportMail($this->distroList(), $file_name, "Kipany-Capillus - ECCO Leads File")
            );
    
            $this->info("Kipany-Capillus - Leads Report Sent!");
        } catch (\Throwable $th) {
            Log::error($th);

            $this->error("Something went wrong");
        }
    }
}
