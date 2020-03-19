<?php

namespace App\Console\Commands\Capillus;

use App\Exports\Capillus\CapillusLeadsExport;
use App\Mail\Capillus\CapillusLeadsReportMail;
use App\Repositories\Capillus\CapillusLeadsRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel as ExcelExcel;

class SendCapillusLeadsReportCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-send-daily-leads-report {--from=default} {--date=default} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus - send daily call data dump report';

    protected $file_name;
    protected $data;

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
            $date = $this->option('date') == 'default' ?
                Carbon::now()->subDay() :
                Carbon::parse($this->option('date'));

            $from = $this->option('from') == 'default' ?
                $date :
                Carbon::parse($this->option('from'));

            $instance = $date->format('m-d-Y');

            $this->file_name = "Kipany Lead {$instance} ECC";

            $this->data = (new CapillusLeadsRepository([
                'date_from' => $from->format('Y-m-d'),
                'date_to' => $date->format('Y-m-d'),
            ]))->data;
            
            $this
                ->postFileToFTP()
                ->sendFileByEmail();
    
            $this->info("Kipany-Capillus - Leads Report Sent!");
        } catch (\Throwable $th) {
            Log::error($th);

            $this->error("Something went wrong");
        }
    }

    protected function postFileToFTP()
    {
        Excel::store(
            new CapillusLeadsExport($this->data), // Create file
            $this->file_name.".csv", // file name
            'kipany-sftp', // disk,
            ExcelExcel::CSV
        );

        return $this;
    }

    protected function sendFileByEmail()
    {
        $file_name = $this->file_name . ".xlsx";

        Excel::store(
            new CapillusLeadsExport($this->data), // Create file
            $file_name // file name
        );

        Mail::send(
            new CapillusLeadsReportMail(
                $this->distroList(),
                $file_name,
                "Kipany-Capillus - ECCO Leads File"
            )
        );

        return $this;
    }
}
