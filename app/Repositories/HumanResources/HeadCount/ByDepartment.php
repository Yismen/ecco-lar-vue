<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Department;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class ByDepartment implements HumanResourcesInterface
{
    public function setup()
    {

    }

    public function count()
    {
        return Department::withCount(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }

    public function list()
    {
        return Department::with(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }
}

