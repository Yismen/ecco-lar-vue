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

        \App\Console\Commands\Because\BecauseFlashReportCommand::class,
        \App\Console\Commands\Because\PullDailyPerformanceDataCommand::class,
        \App\Console\Commands\Because\SendDailyPerformanceReportCommand::class,

        \App\Console\Commands\Capillus\SendFlashReportCommand::class,
        \App\Console\Commands\Capillus\SendCapillusLeadsReportCommand::class,
        \App\Console\Commands\Capillus\PullDailyPerformanceDataCommand::class,
        \App\Console\Commands\Capillus\SendDailyPerformanceReportCommand::class,
        \App\Console\Commands\Capillus\SendAgentCallDataDumpReport::class,
        \App\Console\Commands\Capillus\SendAgentReportCommand::class,
        \App\Console\Commands\Capillus\SendCapillusCallTypeCommand::class,

        \App\Console\Commands\Political\SendPoliticalFlashReportCommand::class,
        \App\Console\Commands\Political\SendPoliticallHourlyProductionReportCommand::class,

        \App\Console\Commands\Publishing\SendPublishinglHourlyProductionReportCommand::class,

        \App\Console\Commands\General\SendGeneralDailyProductionReportCommand::class,

        \App\Console\Commands\Wow\SendWowDailyReportCommand::class,

        \App\Console\Commands\EmployeesHired::class,

        \App\Console\Commands\EmployeesTerminated::class,
        \App\Console\Commands\FeedSchedulesTable::class,
        \App\Console\Commands\FeedShiftsTableCommand::class,
        \App\Console\Commands\MigrationStatus::class,
        \App\Console\Commands\UpdateSlugs::class,
        \App\Console\Commands\DainsysInit::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune --hours=24')->dailyAt('06:40')->timezone('America/New_York');

        $schedule->command('dainsys:laravel-logs laravel- --clear --keep=8')->dailyAt('04:00')->timezone('America/New_York');

        $schedule->command('dainsys:feed-shifts --hours=7.5 --saturday=1')->dailyAt('14:59')->timezone('America/New_York');
        $schedule->command('dainsys:feed-schedules --days=15 --since-days-ago=0')->dailyAt('15:10')
            ->timezone('America/New_York');

        $schedule->command('dainsys:employees-hired --months=1')->weeklyOn(2, '15:58')->timezone('America/New_York');
        $schedule->command('dainsys:employees-hired --months=1')->weeklyOn(5, '15:58')->timezone('America/New_York');
        $schedule->command('dainsys:employees-terminated --months=1')->weeklyOn(2, '15:59')->timezone('America/New_York');
        $schedule->command('dainsys:employees-terminated --months=1')->weeklyOn(5, '15:59')->timezone('America/New_York');


        $schedule->command('dainsys:general-rc-production-report')->dailyAt('06:25')->timezone('America/New_York');

        // $schedule->command('dainsys:capillus-send-flash-report')->twiceDaily(0, 3)->timezone('America/New_York');
        // $schedule->command('dainsys:capillus-send-flash-report')->twiceDaily(6, 9)->timezone('America/New_York');
        // $schedule->command('dainsys:capillus-send-flash-report')->twiceDaily(12, 15)->timezone('America/New_York');
        // $schedule->command('dainsys:capillus-send-flash-report')->twiceDaily(18, 21)->timezone('America/New_York');


        // $schedule->command('dainsys:capillus-send-agent-report')->dailyAt('05:55')->timezone('America/New_York');

        // $schedule->command('dainsys:capillus-pull-daily-performance-data')->dailyAt('05:45')->timezone('America/New_York');
        // $schedule->command('dainsys:capillus-send-daily-performance-report')->dailyAt('06:00')->timezone('America/New_York');

        // $schedule->command('dainsys:capillus-send-agent-call-data-dump-report')->dailyAt('06:10')->timezone('America/New_York');

        // $schedule->command('dainsys:capillus-send-daily-leads-report')->dailyAt('03:00')->timezone('America/New_York');

        // $schedule->command('dainsys:capillus-send-calls-type-report')->dailyAt('03:30')->timezone('America/New_York');

        // $schedule->command('dainsys:because-send-flash-report')->twiceDaily(0, 3)->timezone('America/New_York');
        // $schedule->command('dainsys:because-send-flash-report')->twiceDaily(6, 9)->timezone('America/New_York');
        // $schedule->command('dainsys:because-send-flash-report')->twiceDaily(12, 15)->timezone('America/New_York');
        // $schedule->command('dainsys:because-send-flash-report')->twiceDaily(18, 21)->timezone('America/New_York');
        // $schedule->command('dainsys:because-pull-daily-performance-data')->dailyAt('06:35')->timezone('America/New_York');
        // $schedule->command('dainsys:because-send-daily-performance-report')->dailyAt('06:55')->timezone('America/New_York');

        $schedule->command('dainsys:political-send-hourly-flash')->hourly()->timezone('America/New_York');
        $schedule->command('dainsys:political-send-hourly-production-report')->hourlyAt(59)->timezone('America/New_York');

        $schedule->command('dainsys:publishing-send-hourly-production-report')->hourlyAt(58)->timezone('America/New_York');

        // $schedule->command('dainsys:wow-daily-report')->dailyAt('07:00')->timezone('America/New_York');

        $schedule->command('backup:run')->dailyAt('21:15')->timezone('America/New_York');
        $schedule->command('backup:clean')->dailyAt('22:15')->timezone('America/New_York');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
