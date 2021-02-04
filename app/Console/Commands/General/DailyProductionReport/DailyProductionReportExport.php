<?php

namespace App\Console\Commands\General\DailyProductionReport;

use App\Console\Commands\Common\HourlyProductionReport\Sheets\DataSheet;
use App\Console\Commands\Common\HourlyProductionReport\Sheets\DispositionsSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DailyProductionReportExport implements WithMultipleSheets
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
        $sheets[] = new DataSheet($this->repo->data, "General Production Report", "General Daily Production Report");
        $sheets[] = new DispositionsSheet($this->repo->dispositions, "General Dispositions", "General Daily Dispositions Report");

        return $sheets;
    }
}
