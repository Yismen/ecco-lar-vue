<?php

namespace App\Console;

use App\Console\Commands\CapillusAgentCallDataDumpCommand;
use App\Console\Commands\CapillusAgentReportCommand;
use App\Console\Commands\CapillusDailyLogTimeCommand;
use App\Console\Commands\CapillusFlashCommand;
use App\Console\Commands\CapillusLeadsCommand;
use App\Console\Commands\CapillusMTDAgentsCallsReportCommand;
use App\Console\Commands\CapillusPullDailyPerformanceDataCommand;
use App\Console\Commands\CapillusSendDailyPerformanceReportCommand;
use App\Console\Commands\EmployeesHired;
use App\Console\Commands\EmployeesTerminated;
use App\Console\Commands\FeedSchedulesTable;
use App\Console\Commands\FeedShiftsTableCommand;
use App\Console\Commands\MigrationStatus;
use App\Console\Commands\UpdateSlugs;
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
        CapillusMTDAgentsCallsReportCommand::class,
        CapillusDailyLogTimeCommand::class,
        CapillusFlashCommand::class,
        CapillusLeadsCommand::class,
        CapillusPullDailyPerformanceDataCommand::class,
        CapillusSendDailyPerformanceReportCommand::class,
        CapillusAgentCallDataDumpCommand::class,
        CapillusAgentReportCommand::class,
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
        
        // $schedule->command('dainsys:capillus-daily-log-time')->dailyAt('05:00')->timezone('America/New_York');
        // $schedule->command('dainsys:capillus-mtd-agents-calls')->dailyAt('05:02')->timezone('America/New_York');
        
        $schedule->command('dainsys:capillus-flash')->twiceDaily(0, 3)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(6, 9)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(12, 15)->timezone('America/New_York');
        $schedule->command('dainsys:capillus-flash')->twiceDaily(18, 21)->timezone('America/New_York');
        
        
        $schedule->command('dainsys:capillus-pull-daily-permance-data --date=default')->dailyAt('05:45')
        ->timezone('America/New_York');
        $schedule->command('dainsys:capillus-send-agent-report')->dailyAt('05:55')->timezone('America/New_York');
        $schedule->command('dainsys:capillus-send-daily-permance-report --date=default')->dailyAt('06:00')
        ->timezone('America/New_York');
                
        $schedule->command('dainsys:capillus-send-agent-call-data-dump-report')->dailyAt('06:10')->timezone('America/New_York'); 
        $schedule->command('dainsys:capillus-send-daily-leads-report')->dailyAt('04:00')->timezone('America/New_York');
        
    }
}
