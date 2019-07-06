<?php

namespace App\Console\Commands;

use App\Employee;
use App\Schedule;
use Illuminate\Console\Command;

class FeedSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:feed-schedules {start-day=1 : An Integer representing the first day of the week. Monday is day 1. Min 0}
                                                    {end-day=5 : An Integer representing the final day to schedule. 7 is the highest allowed for Sunday.}
                                                    {--hours=8 : The amount of hours for the given schedule}';

    protected $error_message = '';

    protected $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

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
        $collection = Employee::actives()->whereDoesntHave('schedules')->get();

        $bar = $this->output->createProgressBar($collection->count());
        $bar->start();

        foreach ($collection as $row) {
            for ($i = $this->argument('start-day'); $i <= $this->argument('end-day'); ++$i) {
                $day = $this->days[$i - 1];

                $schedule = (new Schedule())->createFor(
                    $row->id, $day, $this->option('hours')
                );
            }

            $bar->advance();
        }

        $bar->finish();

        return $this->info('done');
    }

    private function validate()
    {
        if ($this->argument('start-day') < 1
            || $this->argument('start-day') > 7
            || $this->argument('end-day') < 1
            || $this->argument('end-day') > 7
            || $this->option('hours') < 0
            || $this->option('hours') > 9
            || $this->argument('end-day')) {
            return false;
        }

        return true;
    }
}
