<?php

namespace App\Exports\Capillus;

use App\Console\Commands\CapillusCommandsTrait;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CapillusAgentExport implements WithMultipleSheets
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

        $periods =  [            
            'pd',
            'wtd',
            'mtd',
            'ptd',        
        ];

        foreach ($periods as $period) {
            $sheets[] = new CapillusAgentReportExport(['date' => $this->date, 'period' => $period]);
        }
        
        return $sheets;
    }
}
