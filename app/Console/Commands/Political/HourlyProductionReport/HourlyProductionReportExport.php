<?php

namespace App\Console\Commands\Political\HourlyProductionReport;

use App\Console\Commands\Capillus\CapillusCommandsTrait;
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
        $sheets[] = new DataSheet($this->repo->data);
        $sheets[] = new DispositionsSheet($this->repo->dispositions);
        
        return $sheets;
    }
}
