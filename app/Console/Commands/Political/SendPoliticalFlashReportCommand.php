<?php

namespace App\Console\Commands\Political;

use App\Console\Commands\Traits\NotifyUsersOnFailedCommandsTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Political\FlashReportExport;
use App\Mail\Political\PoliticalFlashMail;
use App\Repositories\Political\PoliticalFlashRepository;
use Illuminate\Support\Facades\Mail;

class SendPoliticalFlashReportCommand extends Command
{
    use NotifyUsersOnFailedCommandsTrait;
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
            
            $instance = Carbon::now()->format('Ymd_His');
            $file_name = "Political Flash Report {$instance}.xlsx";

            $flash = (new PoliticalFlashRepository([
                'date_from' => $this->date_from,
                'date_to' => $this->date_to
            ]));

            if ($flash->hasHours()) {
                Excel::store(new FlashReportExport($flash), $file_name);

                Mail::send(
                    new PoliticalFlashMail($this->distroList(), $file_name, "Political Hourly Flash")
                );
        
                $this->info("Political Hourly Flash sent!");
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
            Carbon::now() :
            Carbon::parse($this->option('date'));

            
        $this->date_from =  $this->option('from') == 'default' ?
            $this->date_to :
            Carbon::parse($this->option('from'));

        return $this;
    }
}
