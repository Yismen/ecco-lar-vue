<?php

namespace App\Repositories\HumanResources\HeadCount;

use App\Employee;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary.
 */
class ByStatus implements HumanResourcesInterface
{
    public function setup()
    {
        return [
            'actives' => Employee::actives(),
            'inactives' => Employee::inactives(),
        ];
    }

    public function count()
    {
        return [
            'actives' => $this->setup()['actives']->count(),
            'inactives' => Employee::inactives()->count(),
        ];
    }

    public function list()
    {
        return [
            'actives' => $this->setup()['actives']->get(),
            'inactives' => Employee::inactives()->get(),
        ];
    }
}
