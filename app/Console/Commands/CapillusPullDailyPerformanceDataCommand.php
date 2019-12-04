<?php

namespace App\Console\Commands;

use App\CapillusDailyPerformance;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\Capillus\CapillusDailyLogTimeMail;
use App\Exports\Capillus\CapillusAgentLogTimeExport;
use App\Repositories\Capillus\CapillusPullDailyPerformanceDataRepository;
use Illuminate\Support\Facades\Mail;

class CapillusPullDailyPerformanceDataCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-pull-daily-permance-data {--date=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus - pull daily performance data';

    protected $repo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->repo = new CapillusPullDailyPerformanceDataRepository;
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

            $date = $date->format('Y-m-d H:i:s');

            foreach ($this->campaigns as $campaign) {
                // Gather the data from the DB
                $results = $this->repo->getData($campaign, $date);
                
                    
                if (count($results) > 0) {
                    $results = collect($results[0]);
                    // Save the data to my table
                    (new CapillusDailyPerformance)
                        ->removeIfExists([
                            'date' => $results->get('Current Date'),
                            'campaign' => $campaign
                        ])
                        ->create($this->getArrayFields($results));
                }
            }
            
            $this->info("Data pulled for date {$date}");
        } catch (\Throwable $th) {
            $this->error("Something went wrong...!");

            Log::error($th);
        }        
    }

    
}
