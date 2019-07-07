<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\Inspire',
        'App\Console\Commands\FeedSchedules',
        'App\Console\Commands\MigrationStatus',
        'App\Console\Commands\EmployeesHired',
        'App\Console\Commands\EmployeesTerminated',
        'App\Console\Commands\UpdateSlugs',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('dainsys:employees-hired --months=1')->dailyAt('10:20');
        $schedule->command('dainsys:employees-terminated --months=1')->dailyAt('10:20');
    }
}
