<?php

namespace App\Console\Commands;

use App\Employee;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FeedSchedulesTable extends Command
{
    protected $days;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:feed-schedules {--days=1 : An Integer representing the number of days from today to feed: Min: 0, Max: 60}
    {--since-days-ago=0 : An Integer representing the number of days before today to feed from: Min: 0, Max: 140}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feed the schedules table with all employees who does not have a schedule';

    /**
     * Create a new command instance.
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
        $this->days = (int) $this->option('days');

        if (!$this->validate()) {
            return $this->error('Invalid arguments...');
        }

        $collection = Employee::actives()->whereHas('shift')->get();

        $bar = $this->output->createProgressBar($collection->count());
        $bar->start();

        foreach ($collection as $employee) {
            (new Schedule())->createNew(
                [
                    'employee_id' => $employee->id,
                    'date' => Carbon::now()->subDays($this->option('since-days-ago'))->format('Y-m-d'),
                    'days' => $this->days,
                ]
            );

            $bar->advance();
        }

        $bar->finish();

        return $this->info('done');
    }

    private function validate()
    {
        if (
            $this->days < 1
            || $this->days > 60
        ) {
            return false;
        }

        return true;
    }
}
