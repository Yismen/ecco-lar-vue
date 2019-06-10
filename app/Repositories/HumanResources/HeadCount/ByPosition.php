<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Position;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class ByPosition implements HumanResourcesInterface
{
    public function setup()
    {

    }

    public function count()
    {
        return Position::withCount(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }

    public function list()
    {
        return Position::with(['employees' => function($query) {
            return $query->actives();
        }])->get();
    }
}

