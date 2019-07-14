<?php

namespace App\Repositories\HumanResources\Employees\Rotations;

/**
 * summary.
 */
class ThisYearRotations extends Rotations
{
    protected $hires_filters;

    public function __construct(bool $by_site = false)
    {
        $this->hires_filters = 'No Free';
    }
}
