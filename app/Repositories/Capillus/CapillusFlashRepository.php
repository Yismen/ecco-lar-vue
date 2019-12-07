<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

class CapillusFlashRepository extends CapillusBase
{
    public function todaysData()
    {
        return $this->connection()->select(
            DB::raw("
                declare 
                    @reportDate as smalldatetime, 
                    @campaign as varchar(50) 
                set @reportDate = GETDATE() AT TIME ZONE 'UTC' AT TIME ZONE 'Eastern Standard Time' 
                set @campaign = 'Capillus%' 
                exec 
                    [sp_CapillusFlashReport] @reportDate, @campaign
            ")
        );
    }

    public function yesterdaysData()
    {
        return $this->connection()->select(
            DB::raw("
                declare 
                    @reportDate as smalldatetime, 
                    @campaign as varchar(50) 
                set @reportDate = GETDATE() - 1 AT TIME ZONE 'UTC' AT TIME ZONE 'Eastern Standard Time' 
                set @campaign = 'Capillus%' 
                exec [sp_CapillusFlashReport] @reportDate, @campaign
            ")
        );
    }
}