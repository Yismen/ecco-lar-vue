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
        'App\Console\Commands\ReportEmployeesHired',
        'App\Console\Commands\UpdateSlugs',
        'App\Console\Commands\FeedSchedules',
        'App\Console\Commands\MigrationStatus',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('employees:hired')->everyMinute();
        // $schedule->command('mymigration:status')->everyFiveMinutes();
        // $schedule->command('inspire')->everyMinute();
    }
}
