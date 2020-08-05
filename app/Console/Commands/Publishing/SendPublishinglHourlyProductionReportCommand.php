<?php

namespace App\Console\Commands\Publishing;

use App\Console\Commands\Publishing\HourlyProductionReport\HourlyProductionReportExport;
use App\Console\Commands\Publishing\HourlyProductionReport\HourlyProductionReportRepository;
use App\Console\Commands\Traits\NotifyUsersOnFailedCommandsTrait;
use App\Mail\CommandsBaseMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendPublishinglHourlyProductionReportCommand extends Command
{
    use NotifyUsersOnFailedCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:publishing-send-hourly-production-report {--date=default} {--from=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Hourly Production report to Publishing distro';

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
            $distro = $this->distroList();
            
            $instance = now()->format('Ymd_His');
            $file_name = "Publishing Hourly Production Report {$instance}.xlsx";

            $results = (new HourlyProductionReportRepository([
                'date_from' => $this->date_from,
                'date_to' => $this->date_to
            ]));

            if (count($results->data) > 0) {
                Excel::store(new HourlyProductionReportExport($results), $file_name);

                Mail::send(
                    new CommandsBaseMail($distro, $file_name, "Publishing Hourly Production Report")
                );
            
                $this->info("Publishing Hourly Production Report sent!");
            }
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            
            $this->error("Something went wrong");
        }
    }

    protected function distroList()
    {
        $list = config('dainsys.publishing.distro') ??
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
