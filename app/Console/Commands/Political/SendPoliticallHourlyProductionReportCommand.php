<?php

namespace App\Console\Commands\Political;

use App\Console\Commands\Political\HourlyProductionReport\HourlyProductionReportExport;
use App\Console\Commands\Political\HourlyProductionReport\HourlyProductionReportRepository;
use App\Console\Commands\Traits\NotifyUsersOnFailedCommandsTrait;
use App\Mail\CommandsBaseMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendPoliticallHourlyProductionReportCommand extends Command
{
    use NotifyUsersOnFailedCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:political-send-hourly-production-report {--date=default} {--from=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Hourly Production report to Political distro';

    protected $date_from;

    protected $date_to;

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
            $this->initialBoot();
            
            $instance = now()->format('Ymd_His');
            $file_name = "Political Hourly Production Report {$instance}.xlsx";

            $results = (new HourlyProductionReportRepository([
                'date_from' => $this->date_from,
                'date_to' => $this->date_to
            ]));

            if (count($results->data) > 0) {
                Excel::store(new HourlyProductionReportExport($results), $file_name);

                Mail::send(
                    new CommandsBaseMail($this->distroList(), $file_name, "Political Hourly Production Report")
                );
            
                $this->info("Political Hourly Production Report sent!");
            }
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            
            $this->error("Something went wrong");
        }
    }

    protected function distroList()
    {
        $list = config('dainsys.political.distro') ??
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    }

    protected function initialBoot()
    {
        $this->date_to = $this->option('date') == 'default' ?
            now()->format('m/d/Y') :
            Carbon::parse($this->option('date'))->format('m/d/Y');

            
        $this->date_from =  $this->option('from') == 'default' ?
            $this->date_to :
            Carbon::parse($this->option('from'))->format('m/d/Y');

        return $this;
    }
}
