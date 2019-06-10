<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Project;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class ByProject implements HumanResourcesInterface
{
    public function setup()
    {

    }

    public function count()
    {
        return Project::withCount(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }

    public function list()
    {
        return Project::with(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }
}

