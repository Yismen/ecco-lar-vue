<?php

namespace App\Repositories\Political;

use App\CapillusDailyPerformance;
use App\Repositories\Capillus\CapillusBase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PoliticalHoursRepository extends CapillusBase
{
    public $data;

    protected $date_from;

    protected $date_to;

    public function __construct(array $options)
    {
        $this->date_from = $options['date_from'];
        $this->date_to = $options['date_to'];

        $this->data = $this->getData();
    }

    protected function getData()
    {
        return $this->connection()->select(
            DB::raw("
                declare @fromDate as smalldatetime, @toDate as smalldatetime, @campaign as varchar(50)
                set @fromDate = '{$this->date_from}'
                set @toDate = '{$this->date_to}'
                
                exec [sp_POL_Campaign_Hours_Total] @fromDate, @toDate
            ")
        );
    }

    
}
