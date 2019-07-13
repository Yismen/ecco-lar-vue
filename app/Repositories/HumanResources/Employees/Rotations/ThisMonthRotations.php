<?php

namespace App\Repositories\HumanResources\Employees\Rotations;

use App\Site;
use App\Employee;
use Carbon\Carbon;
use App\Repositories\HumanResources\HumanResources;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary.
 */
class ThisMonthRotations extends HumanResources implements HumanResourcesInterface
{
    public function count()
    {
        return $this->setup('count');
    }

    public function list()
    {
        return $this->setup('get');
    }

    public function setup($type)
    {
        if ($this->by_site) {
            foreach (Site::orderBy('name')->pluck('name') as $site) {
                $this->results[$site] = [
                    'hires' => $this->query('hires', $site)->$type(),
                    'terminations' => $this->query('terminations', $site)->$type(),
                ];
            }

            return $this->results;
        }

        return $this->results = [
            'hires' => $this->query('hires')->$type(),
            'terminations' => $this->query('terminations')->$type(),
        ];
    }

    public function query($status, $site = '%')
    {
        $employees = $this->$status(Carbon::now());

        return !$this->by_site ?
            $employees :
            $employees->with('site')
                ->whereHas(
                    'site', function ($query) use ($site) {
                        return $query->where('name', 'like', $site);
                    }
                );
    }

    private function hires(Carbon $date)
    {
        return Employee::whereYear('hire_date', $date->year)
            ->whereMonth('hire_date', $date->month);
    }

    private function terminations(Carbon $date)
    {
        return Employee::with('termination')
            ->whereHas('termination', function ($query) use ($date) {
                return $query->whereYear('termination_date', $date->year)
                        ->whereMonth('termination_date', $date->month);
            });
    }
}
