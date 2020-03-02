<?php

namespace App\Console\Political;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Political\FlashReportExport;
use App\Mail\Capillus\CapillusDailyPerformanceMail;
use App\Mail\Political\PoliticalFlashMail;
use Illuminate\Support\Facades\Mail;

class PoliticalSendFlash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:political-send-hourly-flash {--date=default} {--from=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a hourly flash report to political distro';

    /**
     * Create a new command instance.
     *
     * @return void
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
        try {
            $instance = Carbon::now()->format('Ymd_His');
            $file_name = "Political Flash Report {$instance}.xlsx";

            $date_to = $this->option('date') == 'default' ? 
                Carbon::now()->subDay() : 
                Carbon::parse($this->option('date'));            

            $date_from = $this->option('from') == 'default' ?
                $date_to :
                Carbon::parse($this->option('from'));

            Excel::store(new FlashReportExport([
                'date_from' => $date_from,
                'date_to' => $date_to
            ]), $file_name);

            Mail::send(
                new PoliticalFlashMail($this->distroList(), $file_name, "Political Hourly Flash")
            );
    
            $this->info("Political Hourly Flash sent!");

        } catch (\Throwable $th) {
            Log::error($th);

            $this->error("Something went wrong");
        }        
    }

    protected function distroList()
    {
        $list = config('dainsys.political.distro') ??
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    }
}
