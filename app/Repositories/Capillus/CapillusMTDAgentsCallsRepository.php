<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

class CapillusMTDAgentsCallsRepository extends CapillusBase
{
    public function report($dial_group, $from, $to)
    {
        return $this->connection()->select(
            DB::raw("
                select
                    agent_id, agent_fname, agent_lname, count(*) as [Total Calls Handled], 
                    sum(case
                        when agent_disposition = 'Sale - Cap 82' then 1
                        else 0
                    end) as [Total Cap Ultra Sales], 
                    sum(case
                        when agent_disposition = 'Sale - Cap 202' then 1
                        else 0
                    end) as [Total Cap Plus Sales], 
                    sum(case
                        when agent_disposition = 'Sale - Cap Pro' then 1
                        else 0
                    end) as [Total Cap Pro Sales]
                from
                    Inbound_Call_Detail_Download
                where
                    gate_name like '{$dial_group}%'	
                    and agent_id <> ''
                    and enqueue_time between '{$from}' and '{$to}' 
                group by 
                    agent_id, agent_fname, agent_lname
                order by 
                    agent_fname, agent_lname
            ")
        );
    }
}