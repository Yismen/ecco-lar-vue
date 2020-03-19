<?php

namespace App\Console\Commands\Capillus;

use App\Exports\Capillus\CapillusAgentExport;
use App\Mail\Capillus\CapillusAgentReportMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class SendAgentReportCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-send-agent-report {--date=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus - send daily agent report';

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
            $file_name = "Kipany-Capillus - Agent Report {$instance}.xlsx";

            $date = $this->option('date') == 'default' ?
                Carbon::now()->subDay() :
                Carbon::parse($this->option('date'));
            
            Excel::store(new CapillusAgentExport($date), $file_name);

            Mail::send(
                new CapillusAgentReportMail($this->distroList(), $file_name, "Kipany-Capillus - Agent Report")
            );
    
            $this->info("Kipany-Capillus - Agent Report sent!");
        } catch (\Throwable $th) {
            Log::error($th);

            $this->error("Something went wrong");
        }
    }
}
