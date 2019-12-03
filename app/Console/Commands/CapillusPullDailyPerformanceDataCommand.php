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
            
            // Gather the data from the DB
            $campaign = 'Capillus DRTV';
            $date = $this->option('date') == 'default' ? 
                Carbon::now()->subDay() : 
                Carbon::parse($this->option('date'));

            $results = collect(
                $this->repo->getData($campaign, $date->format('Y-m-d H:i:s'))[0]
            )->toArray();

            // Save the data to my table
            (new CapillusDailyPerformance)
                ->removeIfExists($results['Current Date'])
                ->create($this->getArrayFields($results));

        } catch (\Throwable $th) {
            Log::error($th);
        }        
    }

    
}
