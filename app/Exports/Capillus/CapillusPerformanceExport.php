<?php

namespace App\Exports\Capillus;

use App\Console\Commands\Capillus\CapillusCommandsTrait;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CapillusPerformanceExport implements WithMultipleSheets
{
    use CapillusCommandsTrait;
    
    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new CapillusPerformanceReportExport(['date' => $this->date, 'campaign' => '%']);

        foreach ($this->capillusCampaigns() as $campaign) {
            $sheets[] = new CapillusPerformanceReportExport(['date' => $this->date, 'campaign' => $campaign]);
        }
        
        return $sheets;
    }
}
