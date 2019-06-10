<?php

namespace App\Repositories\HumanResources\Employees\Rotations;

use App\Employee;
use Carbon\Carbon;
use App\Repositories\HumanResources\HumanResourcesInterface;

/**
 * summary
 */
class ThisMonthRotations implements HumanResourcesInterface
{
    protected $date;
    protected $hires;
    protected $terminations;

    public function __construct()
    {
        $this->date = (new Carbon())->month;
        $this->hires = Employee::whereMonth('hire_date', $this->date);
        $this->terminations = Employee::whereHas('termination', function($query) {
            return $query->whereMonth('termination_date', $this->date);
        });
    }

    public function setup()
    {

    }

    public function count()
    {
        return [
            'hires' => $this->hires->count(),
            'terminations' => $this->terminations->count(),
        ];
    }

    public function list()
    {
        return [
            'hires' => $this->hires->get(),
            'terminations' => $this->terminations->get(),
        ];
    }
}
