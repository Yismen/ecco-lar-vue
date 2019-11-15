<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

class CapillusPullDailyPerformanceDataRepository extends CapillusBase
{
    
    public function getData($dial_group, $date)
    {
        return $this->data =  $this->connection()->select(
            DB::raw("
                declare 
                    @reportDate as smalldatetime, 
                    @campaignName as varchar(50)
                set 
                    @reportDate = '{$date}'
                    set @campaignName = '{$dial_group}'
                exec 
                    sp_CapillusProductionReport @reportDate, @campaignName
            ")
        );

        return $this;
    }
}