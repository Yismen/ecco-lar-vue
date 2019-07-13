<?php

namespace App\Repositories\HumanResources\Birthdays;

use App\Site;
use App\Employee;
use Carbon\Carbon;
use App\Repositories\HumanResources\HumanResources;
use App\Repositories\HumanResources\HumanResourcesInterface;

class BirthdaysNextMonth extends HumanResources implements HumanResourcesInterface
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
            foreach (Site::orderBy('name')->pluck('name') as $id => $name) {
                $this->results[$name] = $this->query('actives', $name)->$type();
            }

            return $this->results;
        }

        return $this->results = $this->query('actives')->$type();
    }

    public function query($status, $site = '%')
    {
        $date = Carbon::now()->addMonth();

        $employees = Employee::$status()
            ->orderByRaw('Day(date_of_birth)')
            ->whereMonth('date_of_birth', $date->month);

        return !$this->by_site ?
            $employees :
            $employees
            ->with('site')
            ->whereHas(
                'site', function ($query) use ($site) {
                    return $query->where('name', 'like', $site);
                }
            );
    }
}
