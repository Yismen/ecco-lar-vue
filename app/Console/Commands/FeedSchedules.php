<?php

namespace App\Console\Commands;

use App\Employee;
use App\Schedule;
use Illuminate\Console\Command;

class FeedSchedules extends Command
{
    protected $start_day;
    protected $end_day;
    protected $hours;

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
        $this->start_day = (int) $this->argument('start-day');
        $this->end_day = (int) $this->argument('end-day');
        $this->hours = (int) $this->option('hours');

        if (!$this->validate()) {
            return $this->error('Invalid arguments. Must pass only integers. Start and End days correspond to days of the week, where 1 = Monday and 7 = Sunday. Hours corresponds to the amount of hours per shift, min 1, max 10.');
        }

        $collection = Employee::actives()->whereDoesntHave('schedules')->get();

        $bar = $this->output->createProgressBar($collection->count());
        $bar->start();

        foreach ($collection as $row) {
            for ($i = $this->start_day; $i <= $this->end_day; ++$i) {
                $day = $this->days[$i - 1];

                $schedule = (new Schedule())->createFor(
                    $row->id, $day, $this->hours
                );
            }

            $bar->advance();
        }

        $bar->finish();

        return $this->info('done');
    }

    private function validate()
    {
        if ($this->start_day < 1
            || $this->start_day > 7
            || $this->end_day < 1
            || $this->end_day > 7
            || $this->hours < 1
            || $this->hours > 10
            || $this->end_day < $this->start_day) {
            return false;
        }

        return true;
    }
}
