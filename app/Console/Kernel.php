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
        'App\Console\Commands\FeedSchedulesTable',
        'App\Console\Commands\FeedShiftsTableCommand',
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
        $schedule->command('telescope:prune --hours=48')->dailyAt('12:20');
        $schedule->command('dainsys:feed-shifts --hours=7.5 --saturday=1')->dailyAt('14:59');
        $schedule->command('dainsys:feed-schedules --days=10')->dailyAt('15:10');
        $schedule->command('dainsys:employees-hired --months=1')->dailyAt('15:59');
        $schedule->command('dainsys:employees-terminated --months=1')->dailyAt('15:59');
    }
}
