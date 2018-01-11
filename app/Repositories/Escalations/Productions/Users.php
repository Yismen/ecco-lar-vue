<?php

namespace App\Repositories\Escalations\Productions;

use App\User;
use Carbon\Carbon;

class Users
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    private function fetch($date)
    {
        return $this->user->select(['name', 'id'])
            ->whereHas('escalationsRecords', function($query) use ($date){
                $query->whereDate('insert_date', '=', $date);
            })
            ->withCount(['escalationsRecords' => function($query) use ($date) {
                $query->whereDate('insert_date', '=', $date);
            }]);
    }

    public function byDate($date)
    {
        return $this->fetch($date)
            // ->with('hours')
            ;
    }

    public function today()
    {
        $date = (new Carbon)->today()->format("Y-m-d");
        return $this->byDate($date);
    }
}