<?php

namespace App\Console\Commands\Political\HourlyProductionReport;

use App\Console\Commands\Capillus\CapillusCommandsTrait;
use App\Console\Commands\Common\HourlyProductionReport\Sheets\DataSheet as SheetsDataSheet;
use App\Console\Commands\Common\HourlyProductionReport\Sheets\DispositionsSheet as SheetsDispositionsSheet;
use App\Console\Commands\Political\HourlyProductionReport\Sheets\DataSheet;
use App\Console\Commands\Political\HourlyProductionReport\Sheets\DispositionsSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HourlyProductionReportExport implements WithMultipleSheets
{
    // use CapillusCommandsTrait;

    /**
     * Array of hours
     *
     * @var array
     */
    protected $repo;

    public function __construct($repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new SheetsDataSheet($this->repo->data, "Production Report", "Political Hourly Production Report");
        $sheets[] = new SheetsDispositionsSheet($this->repo->dispositions, "Dispositions", "Political Hourly Dispositions Report");
        
        return $sheets;
    }
}
