<?php

namespace App\Console\Commands\Capillus;

use App\CapillusDailyPerformance;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Repositories\Capillus\CapillusPullDailyPerformanceDataRepository;

class PullDailyPerformanceDataCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-pull-daily-performance-data {--date=default} {--from=default}';

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

            $date_from = $this->option('from') == 'default' ?
                Carbon::parse($date) :
                Carbon::parse($this->option('from'));
            ;
                
            while ($date_from <= $date) {
                foreach ($this->capillusCampaigns() as $campaign) {
                    // Gather the data from the DB
                    $results = $this->repo->getData($campaign, $date_from->format('Y-m-d H:i:s'));
                    
                        
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
                

                $date_from->addDay();
            }

            $this->info("Data pulled for date {$date}");
        } catch (\Throwable $th) {
            $this->error("Something went wrong...!");

            Log::error($th);
        }
    }
}
