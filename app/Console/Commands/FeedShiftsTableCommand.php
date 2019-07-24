<?php

namespace App\Console\Commands;

use App\Shift;
use App\Employee;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class FeedShiftsTableCommand extends Command
{
    protected $start_day;
    protected $end_day;
    protected $hours;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:feed-shifts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feed the shifts table with all employees who does not have a shift';

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
        $collection = Employee::actives()->whereDoesntHave('shift')->get();

        $bar = $this->output->createProgressBar($collection->count());
        $bar->start();

        foreach ($collection as $employee) {
            (new Shift())->create(
                [
                    'employee_id' => $employee->id,
                    'slug' => Str::slug($employee->fullName),
                    'start_at' => '07:00:00',
                    'end_at' => '16:00:00',
                    'mondays' => '8',
                    'tuesdays' => '8',
                    'wednesdays' => '8',
                    'thursdays' => '8',
                    'fridays' => '8',
                    'saturdays' => '0',
                    'sundays' => '0',
                ]
            );

            $bar->advance();
        }

        $bar->finish();

        return $this->info('done');
    }
}
