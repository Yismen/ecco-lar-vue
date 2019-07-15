<?php

namespace App\Repositories\SitesOverview\Stats;

use Carbon\Carbon;
use App\Performance;
use Illuminate\Http\Request;

/**
 * summary.
 */
class MonthlyStats
{
    protected $months = 6;
    protected $site;
    protected $project;
    protected $temp_date;
    protected $query;

    public function __construct(Request $request)
    {
        $this->site = $request->site ?? '%';
        $this->project = $request->project ?? '%';
    }

    public function get()
    {
        return $this->results();
    }

    public function fields(array $fields = ['transactions'])
    {
        $this->fields = $fields;

        return $this;
    }

    public function months(int $months = 6)
    {
        $this->months = $months;

        return $this;
    }

    private function results()
    {
        for ($interval = $this->months; 0 !== $interval; --$interval) {
            $this->temp_date = (new Carbon())->subMonths($interval - 1);
            $month = $this->temp_date->format('Y-m');

            foreach ($this->fields as $field) {
                $this->results[$field][$month] = $this->query()->sum($field);
            }
        }

        return $this->results;
    }

    private function query()
    {
        $site = $this->site;
        $project = $this->project;

        return Performance::with('campaign', 'employee')
            ->whereYear('date', $this->temp_date->year)
            ->whereMonth('date', $this->temp_date->month)
            ->whereHas(
                'employee', function ($query) use ($site) {
                    return $query->with('site')
                        ->whereHas('site', function ($query) use ($site) {
                            return $query->where('name', 'like', $site);
                        });
                }
            )
            ->whereHas(
                'campaign', function ($query) use ($project) {
                    return $query->with('project')
                        ->whereHas('project', function ($query) use ($project) {
                            return $query->where('name', 'like', $project);
                        });
                }
            );
    }
}
