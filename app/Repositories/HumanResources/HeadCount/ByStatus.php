<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Site;
use App\Employee;
use App\Repositories\HumanResources\HumanResources;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary.
 */
class ByStatus extends HumanResources implements HumanResourcesInterface
{
    public function setup($type)
    {
        if ($this->by_site) {
            foreach (Site::orderBy('name')->pluck('name') as $site) {
                $this->results[$site] = [
                    'actives' => $this->query('actives', $site)->$type(),
                    'inactives' => $this->query('inactives', $site)->$type(),
                ];
            }

            return $this->results;
        }

        return $this->results = [
            'actives' => $this->query('actives')->$type(),
            'inactives' => $this->query('inactives')->$type(),
        ];
    }

    public function count()
    {
        return $this->setup('count');
    }

    public function list()
    {
        return $this->setup('get');
    }

    public function query($status, $site = '%')
    {
        $employees = Employee::orderBy('name')->$status();

        return !$this->by_site ?
            $employees :
            $employees->with('site')
            ->whereHas(
                'site', function ($query) use ($site) {
                    return $query->where('name', 'like', $site);
                }
            );
    }
}
