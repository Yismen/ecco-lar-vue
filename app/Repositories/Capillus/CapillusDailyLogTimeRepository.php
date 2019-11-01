<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

class CapillusDailyLogTimeRepository extends CapillusBase
{
    public function report($dial_group, $from, $to)
    {
        return $this->connection->select(
            DB::raw("
                select
                    *
                from
                    Agent_Session_Report_Raw
                where
                    [Login DTS] between '{$from}' and '{$to}'
                    and [Dial Group] like '{$dial_group}%'
            ")
        );
    }
}