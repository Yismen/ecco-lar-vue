<?php

namespace App\Repositories\BlackHawk_CS\Manager\Quality;

use App\BlackhawkQascore;
use Illuminate\Http\Request;

class Scores
{
    public $monthly;
    public $weekly;
    public $daily;
    
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
        $query = BlackhawkQascore::orderBy('date', 'DESC')
            ->take($this->take)
            ->selectRaw('year(date) as year, date, avg(qa_score) as score, avg(passing) as passing');

        if ($this->request->queue) {
            $query->where('queue', 'like', "%{$this->request->queue}%");
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
            ->groupBy('date')
            ->get();
    }
}
