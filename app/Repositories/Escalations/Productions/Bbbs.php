<?php

namespace App\Repositories\Escalations\Productions;

use App\EscalRecord;
use Illuminate\Support\Facades\DB;

class Bbbs
{
    private $record;

    public function __construct(EscalRecord $record)
    {
        $this->record = $record;
    }

    private function fetch()
    {
        return $this->record
            ->where('is_bbb', true)
            ->with(['user' => function ($query) {
                return $query->orderBy('name');
            }])
            ->with(['escal_client' => function ($query) {
                return $query->orderBy('name');
            }])
            ->orderBy('created_at', 'DESC')
            ->orderBy('escal_client_id')
            ;
    }

    public function byDate($date)
    {
        return $this->fetch()
            ->whereDate('created_at', '=', $date)
            ;
    }

    public function range($from, $to)
    {
        return $this->fetch()
            ->whereBetween('insert_date', [$from, $to])
            ;
    }

    public function days($days = 5)
    {
        return $this->record
            ->select(DB::raw("insert_date, user_id, count(tracking) as records"))
            ->groupBy(['insert_date'])
            ->with('user')
            ->orderBy('insert_date', 'DESC')
            ->take($days);
    }
}
