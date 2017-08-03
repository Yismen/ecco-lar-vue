<?php

namespace App\Repositories\Escalations\Productions;

use App\EscalRecord;
use Illuminate\Support\Facades\DB;

class Records
{
    private $record;

    public function __construct(EscalRecord $record)
    {
        $this->record = $record;
    }

    public function detailedByDate($date)
    {        
        return $this->record
            ->with('user')
            ->with('escal_client')
            ->orderBy('escal_client_id')
            ->whereDate('created_at', '=', $date)
            ;
    }    

    public function byDate($date)
    {
        return $this->record
            ->select(DB::raw("user_id, escal_client_id, count(tracking) as records, insert_date, created_at"))
            ->groupBy(['user_id', 'escal_client_id'])
            ->orderBy('escal_client_id')
            ->whereDate('created_at', '=', $date)
            ->with('user')
            ->with('escal_client')
            ;
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