<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Capillus\CapillusMTDAgentsCallsExport;
use App\Mail\Capillus\CapillusMTDAgentsCallsMail;
use Illuminate\Support\Facades\Mail;

class CapillusMTDAgentsCallsReportCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-mtd-agents-calls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus MTD Agents Calls Report';

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
            $filename = 'Capillus MTD Agents Report.xlsx'; 

            $from = Carbon::now()->subDay()->startOfMonth()->format('m/d/Y');
            $to = Carbon::now()->format('m/d/Y');
            
            Excel::store(
                new CapillusMTDAgentsCallsExport('Cap', $from, $to)
            , $filename);
            
            Mail::send(
                new CapillusMTDAgentsCallsMail($this->distroList(), $filename, "Capillus MTD Agents Calls")
            );
        } catch (\Throwable $th) {
            Log::error($th);
        }        
    }
}
