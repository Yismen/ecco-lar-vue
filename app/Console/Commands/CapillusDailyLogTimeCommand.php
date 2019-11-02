<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\Capillus\CapillusDailyLogTimeMail;
use App\Exports\Capillus\CapillusAgentLogTimeExport;
use Illuminate\Support\Facades\Mail;

class CapillusDailyLogTimeCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-daily-log-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus daily log time.';

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
            $filename = 'Capillus Daily Log Time Report.xlsx'; 

            $from = Carbon::now()->subDay()->format('Ymd');
            $to = Carbon::now()->format('Ymd');

            Excel::store(
                new CapillusAgentLogTimeExport('Cap', $from, $to)
            , $filename);
            
            Mail::send(
                new CapillusDailyLogTimeMail($this->distroList(), $filename, "Capillus Daily Log Time")
            );
        } catch (\Throwable $th) {
            Log::error($th);
        }        
    }
}
