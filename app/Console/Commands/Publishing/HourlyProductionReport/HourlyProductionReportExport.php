<?php

namespace App\Console\Commands\Publishing\HourlyProductionReport;

use App\Console\Commands\Common\HourlyProductionReport\Sheets\DataSheet;
use App\Console\Commands\Common\HourlyProductionReport\Sheets\DispositionsSheet;
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
        $sheets[] = new DataSheet($this->repo->data, "Publishing Production Report", "Publishing Hourly Production Report");
        $sheets[] = new DispositionsSheet($this->repo->dispositions, "Publishing Dispositions", "Publishing Hourly Dispositions Report");
        
        return $sheets;
    }
}
