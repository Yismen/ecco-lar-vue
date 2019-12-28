<?php

namespace App\Console\Commands;

use App\Exports\Capillus\CapillusAgentCallDataDumpExport;
use App\Mail\Capillus\CapillusAgentCallDataDumpEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class CapillusAgentCallDataDumpCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-send-agent-call-data-dump-report {--date=default}';

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
            $instance = Carbon::now()->format('Ymd_His');
            $file_name = "Kipany-Capillus - Agent Call Data Dump {$instance}.xlsx";

            $date = $this->option('date') == 'default' ?
                Carbon::now()->subDay() :
                Carbon::parse($this->option('date'));

            $startOfMonth = Carbon::parse($date)->startOfMonth()->format('m/d/Y');

            Excel::store(new CapillusAgentCallDataDumpExport([
                'date' => $date->format('m/d/Y'),
                'startOfMonth' => $startOfMonth,
                'campaign' => 'Capillus%'
            ]), $file_name);

            Mail::send(
                new CapillusAgentCallDataDumpEmail($this->distroList(), $file_name, "Kipany-Capillus - MTD Agent Call Data Dump")
            );
    
            $this->info("Kipany-Capillus - Agent Call Data Dump sent!");
        } catch (\Throwable $th) {
            Log::error($th);

            $this->error("Something went wrong");
        }
    }
}
