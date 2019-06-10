<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Supervisor;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class BySupervisor implements HumanResourcesInterface
{
    public function setup()
    {

    }

    public function count()
    {
        return Supervisor::whereHas('employees', function($query) {
                return $query->actives();
            })
            ->withCount(['employees' => function($query) {
                return $query->actives();
            }])
            ->get();
    }

    public function list()
    {
        return Supervisor::whereHas('employees', function($query) {
                return $query->actives();
            })
            ->with(['employees' => function($query) {
                return $query->actives();
            }])
            ->get();
    }
}

