<?php

namespace App\Repositories\Escalations3;

use App\EscalRecord;
use Illuminate\Support\Facades\DB;

class Production {
    static public function render()
    {
        return EscalRecord::whereIsAdditionalLine(false)
            ->select(DB::raw('
                escal_records.id as escal_records_id, 
                escal_records.*, 
                count(escal_records.id) as records, 
                escal_records.insert_date as escal_records_insert_date, 
                escal_records.user_id as escal_records_user_id, 
                escal_records.escal_client_id as escal_records_escal_client_id, 
    
                escalation_hours.id as escalation_hours_id, 
                escalation_hours.date as escalation_hours_date, 
                escalation_hours.user_id as escalation_hours_user_id, 
                escalation_hours.client_id as escalation_hours_client_id, 
                escalation_hours.entrance as escalation_hours_entrance, 
                escalation_hours.out as escalation_hours_out, 
                escalation_hours.break as escalation_hours_break, 
                (
                    (TIMESTAMPDIFF(MINUTE, escalation_hours.entrance, escalation_hours.out) - escalation_hours.break) / 60
                ) as escalation_hours_production_hours
            '))
            ->groupBy(['escal_records.user_id', 'escal_records.escal_client_id', 'escal_records.insert_date'])
            ->orderBy('escal_records.insert_date')
            ->orderBy('escal_records.escal_client_id')
            ->leftJoin('escalation_hours', function ($join) {
                return $join
                    ->on('escal_records.user_id', '=', 'escalation_hours.user_id')
                    ->on('escal_records.escal_client_id', '=', 'escalation_hours.client_id')
                    ->on('escal_records.insert_date', '=', 'escalation_hours.date');
            })
            ->with('user')
            ->with('escal_client');
    }
}