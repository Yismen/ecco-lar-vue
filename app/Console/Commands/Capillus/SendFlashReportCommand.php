<?php

namespace App\Console\Commands\Capillus;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\Capillus\CapillusFlashMail;
use App\Exports\Capillus\CapillusFlashReportExport;
use App\Repositories\Capillus\CapillusFlashRepository;

class SendFlashReportCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-send-flash-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send and email to the distro list with the Capillus Flash Report';

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
    
            $file_name = "KNYC E Flash Report {$instance}.xlsx";

            $data = new CapillusFlashRepository();

            Excel::store(new CapillusFlashReportExport($data->data), $file_name);

            Mail::send(
                new CapillusFlashMail($this->distroList(), $file_name, "KNYC E Flash")
            );
    
            $this->info("Capillus Flash report sent!");
        } catch (\Throwable $th) {
            $this->notifyUsersAndLogError($th);
            $this->error("Something went wrong");
        }
    }
}
