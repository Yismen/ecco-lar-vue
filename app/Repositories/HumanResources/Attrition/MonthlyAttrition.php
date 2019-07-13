<?php

namespace App\Repositories\HumanResources\Attrition;

use App\Site;
use App\Employee;
use Carbon\Carbon;
use App\Repositories\HumanResources\HumanResources;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary.
 */
class MonthlyAttrition extends HumanResources implements HumanResourcesInterface
{
    protected $months;

    protected $current_date;

    public function count(int $months = 6)
    {
        $this->months = $months;

        return $this->setup('count');
    }

    public function list(int $months = 6)
    {
        $this->months = $months;

        return $this->setup('get');
    }

    public function setup($type)
    {
        for ($interval = $this->months; 0 !== $interval; --$interval) {
            $this->current_date = (new Carbon())->subMonths($interval - 1);
            $prop = $this->current_date->format('Y-m');

            if ($this->by_site) {
                foreach (Site::orderBy('name')->pluck('name') as $site) {
                    $this->results[$site][$prop]['head_count'] = $this->query('headCount', $site)->$type();
                    $this->results[$site][$prop]['terminations'] = $this->query('terminations', $site)->$type();
                    $this->results[$site][$prop]['hires'] = $this->query('hires', $site)->$type();
                }
            } else {
                $this->results[$prop]['head_count'] = $this->query('headCount')->$type();
                $this->results[$prop]['terminations'] = $this->query('terminations')->$type();
                $this->results[$prop]['hires'] = $this->query('hires')->$type();
            }
        }

        return $this->results;
    }

    public function query($status, $site = '%')
    {
        $employees = $this->$status();

        return !$this->by_site ?
            $employees :
            $employees->with('site')
            ->whereHas(
                'site', function ($query) use ($site) {
                    return $query->where('name', 'like', $site);
                }
            );
    }

    private function headCount()
    {
        $date = $this->current_date;

        return Employee::where('hire_date', '<=', $date->endOfMonth())
            ->where(function ($query) use ($date) {
                $query->actives()
                ->orWhereHas('termination', function ($query) use ($date) {
                    $query->where('termination_date', '>', $date->endOfMonth());
                });
            });
    }

    private function terminations()
    {
        $date = $this->current_date;

        return Employee::with('termination')
            ->whereHas('termination', function ($query) use ($date) {
                return $query->whereYear('termination_date', $date->year)
                ->whereMonth('termination_date', $date->month);
            });
    }

    private function hires()
    {
        $date = $this->current_date;

        return Employee::whereYear('hire_date', $date->year)
            ->whereMonth('hire_date', $date->month);
    }
}
