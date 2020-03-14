<?php

namespace App\Console;

use App\Console\Commands\Capillus\CapillusAgentCallDataDumpCommand;
use App\Console\Commands\Capillus\CapillusAgentReportCommand;
use App\Console\Commands\Capillus\CapillusFlashCommand;
use App\Console\Commands\Capillus\CapillusLeadsCommand;
use App\Console\Commands\Capillus\CapillusPullDailyPerformanceDataCommand;
use App\Console\Commands\Capillus\CapillusSendDailyPerformanceReportCommand;
use App\Console\Commands\EmployeesHired;
use App\Console\Commands\EmployeesTerminated;
use App\Console\Commands\FeedSchedulesTable;
use App\Console\Commands\FeedShiftsTableCommand;
use App\Console\Commands\MigrationStatus;
use App\Console\Commands\UpdateSlugs;
use App\Console\Political\PoliticalSendFlash;
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
        CapillusFlashCommand::class,
        CapillusLeadsCommand::class,
        CapillusPullDailyPerformanceDataCommand::class,
        CapillusSendDailyPerformanceReportCommand::class,
        CapillusAgentCallDataDumpCommand::class,
        CapillusAgentReportCommand::class,
        PoliticalSendFlash::class,
        FeedSchedulesTable::class,
        FeedShiftsTableCommand::class,
        MigrationStatus::class,
        EmployeesHired::class,
        EmployeesTerminated::class,
        UpdateSlugs::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune --hours=24')->dailyAt('06:40')->timezone('America/New_York');

        
        $schedule->command('dainsys:feed-shifts --hours=7.5 --saturday=1')->dailyAt('14:59')->timezone('America/New_York');
        $schedule->command('dainsys:feed-schedules --days=15 --since-days-ago=0')->dailyAt('15:10')
            ->timezone('America/New_York');
        
        $schedule->command('dainsys:employees-hired --months=1')->weeklyOn(2, '15:58')->timezone('America/New_York');
        $schedule->command('dainsys:employees-hired --months=1')->weeklyOn(5, '15:58')->timezone('America/New_York');
        $schedule->command('dainsys:employees-terminated --months=1')->weeklyOn(2, '15:59')->timezone('America/New_York');
        $schedule->command('dainsys:employees-terminated --months=1')->weeklyOn(5, '15:59')->timezone('America/New_York');
        
        $schedule->command('dainsys:capillus-flash')->twiceDaily(0, 3)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(6, 9)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(12, 15)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(18, 21)->timezone('America/New_York');
        
        
        $schedule->command('dainsys:capillus-pull-daily-permance-data')->dailyAt('05:45')
        ->timezone('America/New_York');
        $schedule->command('dainsys:capillus-send-agent-report')->dailyAt('05:55')->timezone('America/New_York');
        $schedule->command('dainsys:capillus-send-daily-permance-report')->dailyAt('06:00')
        ->timezone('America/New_York');
                
        $schedule->command('dainsys:capillus-send-agent-call-data-dump-report')->dailyAt('06:10')->timezone('America/New_York');

        $schedule->command('dainsys:capillus-send-daily-leads-report')->dailyAt('03:00')->timezone('America/New_York');
        
        $schedule->command('dainsys:political-send-hourly-flash')->hourly()->timezone('America/New_York');
    }
}
