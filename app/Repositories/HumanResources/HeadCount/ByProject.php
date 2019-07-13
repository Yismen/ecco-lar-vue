<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Site;
use App\Project;
use App\Repositories\HumanResources\HumanResources;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary.
 */
class ByProject extends HumanResources implements HumanResourcesInterface
{
    protected $type;

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
        $this->type = $type;

        if ($this->by_site) {
            foreach (Site::pluck('name') as $site) {
                $this->results[$site] = $this->query('actives', $site)->get();
            }

            return $this->results;
        }

        return $this->results = $this->query('actives')->get();
    }

    public function query($status, $site = '%')
    {
        $by_site = $this->by_site;

        return 'count' == $this->type ?
            $this->getForCount($status, $site, $by_site) :
            $this->getForList($status, $site, $by_site);

        return !$this->by_site ?
            $employees :
            $employees->with('site')
            ->whereHas(
                'site', function ($query) use ($site) {
                    return $query->where('name', 'like', $site);
                }
            );
    }

    protected function getForCount($status, $site, $by_site)
    {
        return Project::withCount(
            ['employees' => function ($query) use ($status, $site, $by_site) {
                return $by_site ?
                    $query->$status()
                    ->with('termination')
                        ->with('site')
                        ->whereHas(
                            'site', function ($query) use ($site) {
                                return $query->where('name', 'like', $site);
                            }
                        ) :
                    $query->$status();
            }]
        );
    }

    public function getForList($status, $site, $by_site)
    {
        return Project::with(
            ['employees' => function ($query) use ($status, $site, $by_site) {
                return $by_site ?
                    $query->$status()
                    ->with('termination')
                    ->with('site')
                    ->whereHas(
                        'site', function ($query) use ($site) {
                            return $query->where('name', 'like', $site);
                        }
                    ) :

                    $query->$status();
            }]
        );
    }
}
