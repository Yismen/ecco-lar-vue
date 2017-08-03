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
                $query->whereDate('created_at', '=', $date);
            })
            ->withCount(['escalationsRecords' => function($query) use ($date) {
                $query->whereDate('created_at', '=', $date);
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
        return $this->byDate(Carbon::today());
    }
}