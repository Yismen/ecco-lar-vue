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
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\CapillusFlashCommand::class,
        \App\Console\Commands\FeedSchedulesTable::class,
        \App\Console\Commands\FeedShiftsTableCommand::class,
        \App\Console\Commands\MigrationStatus::class,
        \App\Console\Commands\EmployeesHired::class,
        \App\Console\Commands\EmployeesTerminated::class,
        \App\Console\Commands\UpdateSlugs::class,
        \App\Console\Commands\CapillusDailyReportsCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune --hours=24')->dailyAt('06:40')->timezone('America/New_York');
        // $schedule->command('dainsys:capillus-daily')->dailyAt('06:50')->timezone('America/New_York');

        $schedule->command('dainsys:feed-shifts --hours=7.5 --saturday=1')->dailyAt('14:59')->timezone('America/New_York');
        $schedule->command('dainsys:feed-schedules --days=15 --since-days-ago=0')->dailyAt('15:10')->timezone('America/New_York');

        $schedule->command('dainsys:employees-hired --months=1')->weeklyOn(2, '15:58')->timezone('America/New_York');
        $schedule->command('dainsys:employees-hired --months=1')->weeklyOn(5, '15:58')->timezone('America/New_York');
        $schedule->command('dainsys:employees-terminated --months=1')->weeklyOn(2, '15:59')->timezone('America/New_York');
        $schedule->command('dainsys:employees-terminated --months=1')->weeklyOn(5, '15:59')->timezone('America/New_York');

        $schedule->command('dainsys:capillus-flash')->twiceDaily(0, 3)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(6, 9)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(12, 15)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(18, 21)->timezone('America/New_York');
        
    }
}
