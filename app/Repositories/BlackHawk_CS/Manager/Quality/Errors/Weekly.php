<?php

namespace App\Repositories\BlackHawk_CS\Manager\Quality\Errors;

use Illuminate\Http\Request;
use App\BlackhawkQaErrors;
use Carbon\Carbon;

class Weekly
{
    public $this_week;
    public $last_week;
    public $two_weeks_ago;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request->all();
        $this->this_week = $this->thisWeek();
        $this->last_week = $this->lastWeek();
        $this->two_weeks_ago = $this->twoWeeksAgo();
    }

    private function query($from, $to)
    {
        $query = BlackhawkQaErrors::orderBy('count', 'DESC')
            ->selectRaw('weekofyear(date) as week, error_field, count(client) as count')
            ->whereBetween('date', [$from, $to])
            ->groupBy('error_field', 'week');

        if (isset($this->request['queue'])) {
            $query->where('queue', 'like', "%{$this->request['queue']}%");
        }

        return $query;
    }

    private function thisWeek()
    {
        return $this->query(
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        )->get();
    }

    private function lastWeek()
    {
        return $this->query(
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        )->get();
    }

    private function twoWeeksAgo()
    {
        return $this->query(
            Carbon::now()->subWeeks(2)->startOfWeek(),
            Carbon::now()->subWeeks(2)->endOfWeek()
        )->get();
    }
}
