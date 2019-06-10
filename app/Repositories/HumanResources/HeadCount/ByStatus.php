<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Employee;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class ByStatus implements HumanResourcesInterface
{
    public function setup()
    {
    }

    public function count()
    {
        return [
            'actives' => Employee::actives()->count(),
            'inactives' => Employee::inactives()->count(),
        ];
    }

    public function list()
    {
        return [
            'actives' => Employee::actives()->get(),
            'inactives' => Employee::inactives()->get(),
        ];
    }
}

