<?php

namespace App\Repositories\SitesOverview;

use App\Campaign;
use Carbon\Carbon;

class SPHGoalForMonth
{
    private $date;
    protected $request;

    public function __construct($month, $site, $project)
    {
        $date = Carbon::parse($month);

        $this->results = $this->getGoals($date->year, $date->month, $site, $project);
    }

    private function getGoals($year, $month, $site, $project)
    {
        $campaigns = Campaign::with(['performances' => function ($query) use ($year, $month, $site, $project) {
            return $query
                ->with(['employee', 'campaign'])
                ->whereHas('employee', function ($query) use ($site) {
                    return $query->with('site')
                        ->whereHas('site', function ($query) use ($site) {
                            return $query->where('name', 'like', $site);
                        });
                })
                ->whereHas('campaign', function ($query) use ($project) {
                    return $query->with('project')
                        ->whereHas('project', function ($query) use ($project) {
                            return $query->where('name', 'like', $project);
                        });
                })
                ->whereYear('date', $year)
                ->whereMonth('date', $month);
        }])
        ->get();

        $production_time = 0; // sum(hours)
        $weighted_total = 0; // sum(goal * hours)

        foreach ($campaigns as $campaign) {
            $hours = $campaign->performances->sum('production_time');
            $production_time = $production_time + $hours;
            $weighted_total = $weighted_total + ($campaign->sph_goal * $hours);
        }

        return $production_time > 0 ? $weighted_total / $production_time : 0; // sum(goal * hours) / sum(hours)
    }
}
