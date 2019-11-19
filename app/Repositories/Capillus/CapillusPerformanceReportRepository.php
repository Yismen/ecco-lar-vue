<?php

namespace App\Repositories\Capillus;

use App\CapillusDailyPerformance;
use Carbon\Carbon;

class CapillusPerformanceReportRepository
{
    public $data;

    public function __construct(Carbon $date)
    {
        $this->data = [
            'wtd' => $this->wtd($date),
            'mtd' => $this->mtd($date)
        ];
    }

    protected function mtd($date) 
    {
        return $this->query()->mtd($date)                
                ->get();
    }
    protected function wtd($date) 
    {
        return $this->query()->wtd($date)                
                ->get();
    }

    protected function query() 
    {
        return CapillusDailyPerformance::orderBy('date');
    }
}