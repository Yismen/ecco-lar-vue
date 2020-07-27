<?php

namespace App\Exports\Because;

use App\Console\Commands\Because\BecauseCommandsTrait;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BecausePerformanceExport implements WithMultipleSheets
{
    use BecauseCommandsTrait;
    
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

        $sheets[] = new BecausePerformanceReportExport(['date' => $this->date, 'campaign' => '%']);

        foreach ($this->becauseCampaigns() as $campaign) {
            $sheets[] = new BecausePerformanceReportExport(['date' => $this->date, 'campaign' => $campaign]);
        }
        
        return $sheets;
    }
}
