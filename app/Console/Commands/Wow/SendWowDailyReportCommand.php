<?php

namespace App\Console\Commands\Wow;

use App\Console\Commands\Traits\NotifyUsersOnFailedCommandsTrait;
use App\Exports\Wow\WowProductionReport;
use App\Mail\CommandsBaseMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Wow\WowRepository;
use Illuminate\Support\Facades\Mail;

class SendWowDailyReportCommand extends Command
{
    use NotifyUsersOnFailedCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:wow-daily-report {--date=default} {--from=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily report to CTV-WOW distro';

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
            $file_name = "CTV - WOW Daily Report {$instance}.xlsx";

            $results = (new WowRepository([
                'date_from' => $this->date_from,
                'date_to' => $this->date_to
            ]));


            if (count($results->data) > 0) {
                Excel::store(new WowProductionReport($results), $file_name);

                Mail::send(
                    new CommandsBaseMail($this->distroList(), $file_name, "CTV WOW Daily Production Report")
                );
            
                $this->info("Wow Daily Report sent!");
            }
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            
            $this->error("Something went wrong");
        }
    }

    protected function distroList()
    {
        $list = config('dainsys.wow.distro') ??
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    }

    protected function initialBoot()
    {
        $this->date_to = $this->option('date') == 'default' ?
            now()->subDay()->format('m/d/Y') :
            Carbon::parse($this->option('date'))->format('m/d/Y');

            
        $this->date_from =  $this->option('from') == 'default' ?
            $this->date_to :
            Carbon::parse($this->option('from'))->format('m/d/Y');

        return $this;
    }
}
