<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyBirthdays extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::success('Birthdays Jobs');
            return Log::info('Queue Job');
        })->everyMinute();
    }
}
