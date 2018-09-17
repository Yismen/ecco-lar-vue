<?php

namespace App\Repositories\BlackHawk_CS\Manager\Performance;

use Illuminate\Http\Request;
use App\BlackhawkPerformanceSummary;
use Carbon\Carbon;

class Production
{
    public $monthly;
    public $weekly;
    public $daily;
    // public $weekdays;
    // public $weekdays2;
    // public $weekdays_previous_week;
    
    private $request;
    private $take;

    public function __construct(Request $request, $take = 5)
    {
        $this->request = $request;
        $this->take = $take;
        $this->monthly = $this->monthly();
        $this->weekly = $this->weekly();
        $this->daily = $this->daily();
    }

    private function query()
    {
        $query = BlackhawkPerformanceSummary::orderBy('date', 'DESC')
        ->take($this->take)
        ->selectRaw('
            year(date) as year, 
            sum(time_logged_in) as time_logged_in,
            sum(time_online) as time_online,            
            (sum(time_in_chats) + sum(time_in_emails)) as production_time,
            sum(chat_sessions) as chat_sessions,
            sum(email_sessions) as email_sessions,
            sum(time_in_chats) as time_in_chats,
            sum(time_in_emails) as time_in_emails,
            sum(chat_wrap_up_time) as chat_wrap_up_time
        ');
        
        if ($this->request->queue && $this->request->queue == 'chat') {
            $query->selectRaw('(sum(chat_sessions) ) as records');
        } elseif ($this->request->queue && $this->request->queue == 'email') {
            $query->selectRaw('(sum(email_sessions)) as records');
        } else {
            $query->selectRaw('(sum(chat_sessions) + sum(email_sessions)) as records');
        }

        return $query;
    }

    private function monthly()
    {
        return $this->query()
            ->selectRaw('monthname(date) as month')
            ->groupBy('year', 'month')
            ->get();
    }

    private function weekly()
    {
        return $this->query()
            ->selectRaw('weekofyear(date) as week')
            ->groupBy('year', 'week')
            ->get();
    }

    private function daily()
    {
        return $this->query()
            ->selectRaw('date')
            ->groupBy('date')
            ->get();
    }

    private function weekDays()
    {
        $week = Carbon::now()->weekOfYear;
        return $this->query(7)
        ->selectRaw('dayname(date) as dayname, WEEKOFYEAR(date) as week')
        ->groupBy('week', 'dayname')
        ->whereRaw('WEEKOFYEAR(date) = '.$week)
        ->get();
    }
    
    private function weekDaysPreviousWeek()
    {
        $week = Carbon::now()->subWeek()->weekOfYear;
        return $this->query(7)
            ->selectRaw('dayname(date) as dayname, WEEKOFYEAR(date) as week')
            ->groupBy('week', 'dayname')
            ->whereRaw('WEEKOFYEAR(date) = '.$week)
            ->get();
    }
}
