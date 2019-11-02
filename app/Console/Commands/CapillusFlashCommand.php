<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Mail\Capillus\CapillusFlashMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Capillus\CapillusFlashReportExport;

class CapillusFlashCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-flash';

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

            Excel::store(new CapillusFlashReportExport(), $file_name);

            Mail::send(
                new CapillusFlashMail($this->distroList(), $file_name, "KNYC E Flash")
            );
    
            $this->info("Capillus lash report sent!");
        } catch (\Throwable $th) {
            Log::error($th);
        }

    }
}
