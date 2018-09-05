<?php

namespace App\Repositories\HumanResources\Employees;

class Departments 
{


    private $carbon;
    private $now;
    private $today;
    private $three_months_ago;
    private $six_months_ago;
    private $nine_months_ago;
    private $a_year_ago;
    private $three_years_ago;

    public function __construct()
    {
        $this->carbon = new Carbon;
        $this->now = $this->carbon->now();

        $this->today = $this->now->format("Y-m-d");
        $this->three_months_ago = $this->now->subMonths(3)->format("Y-m-d");
        $this->six_months_ago = $this->now->subMonths(6)->format("Y-m-d");
        $this->nine_months_ago = $this->now->subMonths(9)->format("Y-m-d");
        $this->a_year_ago = $this->now->subYear()->format("Y-m-d");
        $this->three_years_ago = $this->now->subYears(3)->format("Y-m-d");
    }


    /**
     * many to many relationship with the employee model
     * @return [array] [employees associated to current Department]
     */
    public function employeesLastTreeMonths()
    {
        return $this->hasManyThrough(Employee::class, Position::class)
            ->whereDate('hire_date', '>=', $this->three_months_ago);
    }

    public function employeesBetweenThreeAndSixMonths()
    {
        return $this->hasManyThrough(Employee::class, Position::class)
            ->whereBetween('hire_date', [$this->six_months_ago, $this->three_months_ago]);
    }

    public function employeesBetweenSixAndNimeMonths()
    {
        return $this->hasManyThrough(Employee::class, Position::class)
            ->whereBetween('hire_date', [$this->nine_months_ago, $this->six_months_ago]);
    }

    public function employeesBetweenNimeMonthsAndAYear()
    {
        return $this->hasManyThrough(Employee::class, Position::class)
            ->whereBetween('hire_date', [$this->a_year_ago, $this->nine_months_ago]);
    }

    public function employeesBetweenOneAndThreeYears()
    {
        return $this->hasManyThrough(Employee::class, Position::class)
            ->whereBetween('hire_date', [$this->three_years_ago, $this->a_year_ago]);
    }

    public function employeesOverThreeYears()
    {
        return $this->hasManyThrough(Employee::class, Position::class)
            ->whereDate('hire_date', '<', $this->three_years_ago);
    }
}