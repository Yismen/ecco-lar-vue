<?php

namespace App\Repositories\HumanResources\Issues;

use App\Site;
use App\Employee;
use App\Repositories\HumanResources\HumanResources;
use App\Repositories\HumanResources\HumanResourcesInterface;

class MissingArs extends HumanResources implements HumanResourcesInterface
{
    public function setup($type)
    {
        if ($this->by_site) {
            foreach (Site::pluck('name') as $id => $name) {
                $this->results[$name] = $this->query('actives', $name)->$type();
            }

            return $this->results;
        }

        return $this->results = $this->query('actives')->$type();
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
        $employees = Employee::$status()
            ->with('ars')
            ->whereDoesntHave('ars');

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

    public function bySite()
    {
        $this->by_site = true;

        return $this;
    }
}
