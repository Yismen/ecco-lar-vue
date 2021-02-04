<?php

namespace App\Console\Commands\General;

use App\Console\Commands\General\DailyProductionReport\DailyProductionReportExport;
use App\Console\Commands\General\DailyProductionReport\DailyProductionReportRepository;
use App\Console\Commands\Traits\NotifyUsersOnFailedCommandsTrait;
use App\Mail\CommandsBaseMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendGeneralDailyProductionReportCommand extends Command
{
    use NotifyUsersOnFailedCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:general-rc-production-report {--date} {--from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily Production report to General distro';

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
            $file_name = "General Daily Production Report " . now()->subDay()->format('Ymd_His') . ".xlsx";
            $results = (new DailyProductionReportRepository([
                'date_from' => $this->date_from,
                'date_to' => $this->date_to
            ]));

            if (count($results->data) > 0) {
                Excel::store(new DailyProductionReportExport($results), $file_name);

                Mail::send(
                    new CommandsBaseMail($distro, $file_name, "General Daily Production Report")
                );

                $this->info("General RC Daily Production Report Sent!");
            }
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);

            $this->error("Something went wrong");
        }
    }

    protected function distroList()
    {
        $list = config('dainsys.workforce.distro') ??
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    }

    protected function initialBoot()
    {
        $this->date_to = !$this->option('date') ?
            now()->subDay()->format('m/d/Y') :
            Carbon::parse($this->option('date'))->format('m/d/Y');


        $this->date_from =  !$this->option('from') ?
            $this->date_to :
            Carbon::parse($this->option('from'))->format('m/d/Y');

        return $this;
    }
}
