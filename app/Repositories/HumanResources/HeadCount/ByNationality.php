<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Nationality;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class ByNationality implements HumanResourcesInterface
{
    public function setup()
    {
    }

    public function count()
    {
        return Nationality::whereHas('employees', function ($query) {
            return $query->actives();
        })
            ->withCount(['employees' => function ($query) {
                return $query->actives();
            }])
            ->get();
    }

    public function list()
    {
        return Nationality::whereHas('employees', function ($query) {
            return $query->actives();
        })
            ->with(['employees' => function ($query) {
                return $query->actives();
            }])
            ->get();
    }
}
