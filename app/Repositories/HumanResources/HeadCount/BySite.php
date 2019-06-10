<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Site;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class BySite implements HumanResourcesInterface
{
    public function setup()
    {

    }

    public function count()
    {
        return Site::withCount(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }

    public function list()
    {
        return Site::with(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }
}

