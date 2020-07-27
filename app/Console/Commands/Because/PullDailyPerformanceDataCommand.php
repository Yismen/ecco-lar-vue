<?php

namespace App\Console\Commands\Because;

use App\BecauseDailyPerformance;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Repositories\Because\BecausePullDailyPerformanceDataRepository;

class PullDailyPerformanceDataCommand extends Command
{
    use BecauseCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:because-pull-daily-performance-data {--date=default} {--from=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Because - pull daily performance data';

    protected $repo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->repo = new BecausePullDailyPerformanceDataRepository;
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
                foreach ($this->becauseCampaigns() as $campaign) {
                    // Gather the data from the DB
                    $results = $this->repo->getData($campaign, $date_from->format('Y-m-d H:i:s'));
                        
                    if (count($results) > 0) {
                        $results = collect($results[0]);
                        // Save the data to my table
                        (new BecauseDailyPerformance())
                            ->removeIfExists([
                                'date' => $results->get('ReportDate'),
                                'campaign' => $campaign
                            ])
                            ->create($this->getArrayFields($results));
                    }
                }
                

                $date_from->addDay();
            }

            $this->info("Data pulled for date {$date}");
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            $this->error("Something went wrong");
        }
    }
}
