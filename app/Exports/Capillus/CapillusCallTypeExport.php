<?php

namespace App\Exports\Capillus;

use App\Console\Commands\Capillus\CapillusCommandsTrait;
use App\Exports\Capillus\CallType\CapillusCallsTypeCountSheet;
use App\Exports\Capillus\CallType\CapillusCallsTypeResultsSheet;
use App\Repositories\Capillus\CapillusCallTypeRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CapillusCallTypeExport implements WithMultipleSheets
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
        $data = new CapillusCallTypeRepository(['date' => $this->date->format('m/d/Y')]);
        
        $sheets = [];

        $sheets[] = new CapillusCallsTypeCountSheet($data->call_types_count);
        $sheets[] = new CapillusCallsTypeResultsSheet($data->call_types_results);
        
        return $sheets;
    }
}
