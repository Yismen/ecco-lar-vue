<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Gender;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class ByGender implements HumanResourcesInterface
{
    public function setup()
    {

    }

    public function count()
    {
        return Gender::withCount(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }

    public function list()
    {
        return Gender::with(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }
}

