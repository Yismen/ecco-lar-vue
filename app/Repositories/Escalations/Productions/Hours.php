<?php

namespace App\Repositories\Escalations\Productions;

use App\EscalationHour;
use Illuminate\Support\Facades\DB;

class Hours
{
    private $hour;

    public function __construct(EscalationHour $hour)
    {
        $this->hour = $hour;
    }

    public function detailedByDate($date)
    {
        return $this->hour
            ->with('user')
            ->with('escal_client')
            ->orderBy('escal_client_id')
            ->whereDate('created_at', '=', $date);
    }

    public function byDate($date)
    {
        return $this->hour
            ->groupBy(['user_id', 'client_id'])
            ->orderBy('client_id')
            ->whereDate('date', '=', $date)
            ->with('user')
            ->with('client')
            // ->with('records')
;
    }

    public function forRecordsInDate()
    {
        return 45;
    }

    public function randBetween($amount = 10, $user_id, $from, $to)
    {
        return $this->hour
            ->whereUserId($user_id)
            ->whereBetween('insert_date', [$from, $to])
            ->inRandomOrder()
            ->take($amount)
            ->with('user');
    }

    public function lastManyDays($days = 5)
    {
        return $this->hour
            ->select(DB::raw('insert_date, count(tracking) as records, count(CASE WHEN is_bbb = 1 THEN 1 ELSE NULL end) as bbbRecords'))
            ->groupBy(['insert_date'])
            ->orderBy('insert_date', 'DESC')
            ->take($days);
    }

    public function usersDays($days = 5)
    {
        return $this->hour
            ->select(DB::raw('insert_date, user_id, count(tracking) as records'))
            ->groupBy(['insert_date', 'user_id'])
            ->with('user')
            ->orderBy('insert_date', 'DESC')
            ->take($days);
    }

    public function search(int $tracking)
    {
        return $this->hour
            ->where('tracking', 'like', "%$tracking%")
            ->with('user')
            ->orderBy('created_at', 'DESC');
    }
}
