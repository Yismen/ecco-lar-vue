<?php

namespace App\Repositories\Capillus;

use App\Connections\RingCentralConnection;
use Illuminate\Support\Facades\DB;

class CapillusPullDailyPerformanceDataRepository extends RingCentralConnection
{
    
    public function getData($dial_group, $date)
    {
        return $this->data =  $this->connection()->select(
            DB::raw("
                declare 
                    @startDate as smalldatetime, @endDate as smalldatetime, @campaignName as varchar(50)
                set @startDate = '{$date}'
                set @endDate = '{$date}'
                set @campaignName = '{$dial_group}' 
                exec 
                    sp_CapillusProductionReport @startDate, @endDate, @campaignName
            ")
        );

        return $this;
    }
}