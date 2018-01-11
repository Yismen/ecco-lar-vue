<?php

namespace App\Repositories\Escalations\Productions;

use Carbon\Carbon;
use App\EscalRecord;
use Illuminate\Support\Facades\DB;
use App\Repositories\Escalations\Productions\Hours;

class Records
{
    private $record;
    private $date;

    public function __construct(EscalRecord $record, Carbon $date)
    {
        $this->record = $record;
        $this->date = $date;
    }

    public function groupedByDate($paginated = false, $pages = 15)
    {
        $records = $this->record
            ->select(['id', 'insert_date'])
            ->orderBy('insert_date', 'DESC')
            ->groupBy('insert_date')
        ;

        if ($paginated) {
            return $records->paginate($pages);
        }

        return $records->get();
    }

    private function detailed()
    {
        return $this->record
            ->with('user')
            ->with('escal_client')
            ->orderBy('escal_client_id', 'asc');
    }

    public function detailedByDate($request)
    {        
        return $this->detailed()
            ->whereDate('insert_date', '=', $request->date)
            ;
    } 

    public function detailedByRange($request)
    {        
        return $this->detailed()
            ->orderBy('insert_date', 'asc')
            ->whereBetween('insert_date', [$request->from, $request->to])
            ;
    }    

    public function byDate($date)
    {
        return $this->query()
            ->whereDate('escal_records.insert_date', '=', $date);
    }

    public function byRange($from, $to)
    {
        return $this->query()
            ->whereDate('escal_records.insert_date', '>=', $from)
            ->whereDate('escal_records.insert_date', '<=', $to);
    }

    public function manyDaysAgo($days = 10)
    {
        $from = (new Carbon)->subDays($days)->format("Y-m-d");
        $to = (new Carbon)->format("Y-m-d");

        return $this->query()
            ->where(DB::raw('date(escal_records.insert_date)'), '>=', $from)
            ->where(DB::raw('date(escal_records.insert_date)'), '<=', $to)
            ->get();
    }

    public function thisWeek()
    {
        $year = $this->date->year;
        $current_week = $this->date->weekOfYear;

        return $this->query()
            ->where(DB::raw('year(escal_records.insert_date)'), '=', $year)
            ->where(DB::raw('WEEKOFYEAR(escal_records.insert_date)'), '=', $current_week)
            ->get();
    }

    public function lastWeek()
    {
        $year = (new Carbon)->subWeek()->year;
        $last_week = (new Carbon)->subWeek()->weekOfYear;

        return $this->query()
            ->where(DB::raw('year(escal_records.insert_date)'), '=', $year)
            ->where(DB::raw('WEEKOFYEAR(escal_records.insert_date)'), '=', $last_week)
            ->get();
    }

    public function thisMonth()
    {
        $year = $this->date->year;
        $current_month = $this->date->month;

        return $this->query()
            ->where(DB::raw('year(escal_records.insert_date)'), '=', $year)
            ->where(DB::raw('month(escal_records.insert_date)'), '=', $current_month)
            ->get();
    }

    public function lastMonth()
    {
        $year = (new Carbon)->subMonth()->year;
        $last_month = (new Carbon)->subMonth()->month;

        return $this->query()
            ->where(DB::raw('year(escal_records.insert_date)'), '=', $year)
            ->where(DB::raw('month(escal_records.insert_date)'), '=', $last_month)
            ->get();
    }

    private function query()
    {
        return $this->record
            ->select(DB::raw("
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
            "))
            ->groupBy(['escal_records.user_id', 'escal_records.escal_client_id', 'escal_records.insert_date'])
            ->orderBy('escal_records.insert_date')
            ->orderBy('escal_records.escal_client_id')
            ->leftJoin('escalation_hours', function($join) {
                return $join
                    ->on('escal_records.user_id', '=', 'escalation_hours.user_id')
                    ->on('escal_records.escal_client_id', '=', 'escalation_hours.client_id')
                    ->on('escal_records.insert_date', '=', 'escalation_hours.date')
                    ;
            })
            ->with('user')
            ->with('escal_client');
    }

    public function randBetween($amount = 10, $user_id, $from, $to)
    {        
        return $this->record
            ->whereUserId($user_id)
            ->whereBetween('insert_date', [$from, $to])
            ->inRandomOrder()
            ->take($amount)
            ->with('user')
            ;
    }

    public function lastManyDays($days = 5)
    {   
        return $this->record
            ->select(DB::raw("insert_date, count(tracking) as records, count(CASE WHEN is_bbb = 1 THEN 1 ELSE NULL end) as bbbRecords"))
            ->groupBy(['insert_date'])
            ->orderBy('insert_date','DESC')
            ->take($days)
            ;
    }

    public function usersDays($days = 5)
    {
        return $this->record
            ->select(DB::raw("insert_date, user_id, count(tracking) as records"))
            ->groupBy(['insert_date', 'user_id'])
            ->with('user')
            ->orderBy('insert_date','DESC')
            ->take($days)
            ;
    }

    public function search(int $tracking)
    {
        return $this->record
            ->where('tracking', 'like', "%$tracking%")
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ;
    }
}