<?php

namespace App\Repositories\BlackHawk_CS\Manager\Quality;

use Illuminate\Http\Request;
use App\BlackhawkQaErrors;
use Carbon\Carbon;

class Errors
{
    public $this_month;
    public $last_month;
    public $two_months_ago;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->this_month = $this->thisMonth();
        $this->last_month = $this->lastMonth();
        $this->two_months_ago = $this->twoMonthsAgo();
    }

    private function query($year, $month)
    {
        $query = BlackhawkQaErrors::orderBy('count', 'DESC')
            ->selectRaw('error_field, year(date) as year, monthname(date) as month, avg(qa_score) as score, avg(passing) as passing, count(client) as count')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy('error_field', 'year', 'month');

        if ($this->request->queue) {
            $query->where('queue', 'like', "%{$this->request->queue}%");
        }

        return $query;
    }

    private function thisMonth()
    {
        $date = Carbon::now();
        return $this->query($date->year, $date->month)->get();
    }

    private function lastMonth()
    {
        $date = Carbon::now();
        $date = $date->subMonth();
        return $this->query($date->year, $date->month)->get();
    }

    private function twoMonthsAgo()
    {
        $date = Carbon::now();
        $date = $date->subMonths(2);
        return $this->query($date->year, $date->month)->get();
    }
}
