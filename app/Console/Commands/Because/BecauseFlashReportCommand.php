<?php

namespace App\Console\Commands\Because;

use App\Exports\Because\BecauseFlashReportExport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\Capillus\CapillusFlashMail;
use App\Exports\Capillus\CapillusFlashReportExport;
use App\Mail\Because\BecauseFlashMail;
use App\Repositories\Because\BecauseFlashRepository;
use App\Repositories\Capillus\CapillusFlashRepository;

class BecauseFlashReportCommand extends Command
{
    use BecauseCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:because-send-flash-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send and email to the distro list with the Because Flash Report';

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
    
            $file_name = "Kipany - Because Flash Report {$instance}.xlsx";

            $data = new BecauseFlashRepository();

            Excel::store(new BecauseFlashReportExport($data->data), $file_name);

            Mail::send(
                new BecauseFlashMail($this->distroList(), $file_name, "Kipany - Because Flash")
            );
    
            $this->info("Because Flash report sent!");
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            $this->error("Something went wrong");
        }
    }
}
