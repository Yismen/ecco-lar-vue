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
    protected $signature = 'dainsys:feed-schedules {start-day=1} {end-day=5} {--hours=8}';

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
        if (!$this->confirm('Do you wish to continue?')) {
            return $this->alert('You Cancelled!');
        }

        if ($this->argument('start-day') < 1 || $this->argument('end-day') > 7) {
            return $this->error('Invalid Arguments. Only numbers between 1 and 7 accepted, corresponding to the day of the weeks!');
        }

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
}
