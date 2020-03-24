<?php

namespace App\Repositories\Capillus;

use App\Connections\RingCentralConnection;
use Illuminate\Support\Facades\DB;

class CapillusFlashRepository extends RingCentralConnection
{
    public $data;

    public function __construct()
    {
        $this->data['todays'] = $this->todaysData();

        $this->data['yesterdays'] = $this->yesterdaysData();
    }

    public function todaysData()
    {
        return $this->execQuery(0);
    }

    public function yesterdaysData()
    {
        return $this->execQuery(1);
    }
    
    protected function execQuery(int $subdays = 0)
    {
        return $this->connection()->select(
            DB::raw("
                declare 
                    @startDate as smalldatetime, @endDate as smalldatetime, @campaign as varchar(50) 
                set @startDate = GETDATE() - {$subdays} AT TIME ZONE 'UTC' AT TIME ZONE 'Eastern Standard Time'
                set @endDate = GETDATE() - {$subdays} AT TIME ZONE 'UTC' AT TIME ZONE 'Eastern Standard Time'
                set @campaign = 'Capillus%'                    
                exec [sp_CapillusFlashReport] @startDate, @endDate, @campaign
            ")
        );
    }
}
