<?php

namespace App\Repositories;

use App\Department;
use App\Employee;
use App\Gender;
use App\Nationality;
use App\Position;
use App\Project;
use App\Site;
use App\Supervisor;

class EmployeeRepository
{
    protected function query()
    {
        return Employee::sorted()->filter(request()->all());
    }

    public static function all()
    {
        $instance = new self();

        return $instance->query()->get();
    }

    public static function actives()
    {
        $instance = new self();

        return $instance->query()->actives()->get();
    }

    public static function byStatus()
    {
        $static = new self();

        return $static->constrained(Gender::class);
    }

    public static function byGender()
    {
        $static = new self();

        return $static->constrained(Gender::class);
    }

    public static function bySite()
    {
        $static = new self();

        return $static->constrained(Site::class);
    }

    public static function byPosition()
    {
        $static = new self();

        return $static->constrained(Position::class);
    }

    public static function byDepartment()
    {
        $static = new self();

        return $static->constrained(Department::class);
    }

    public static function byProject()
    {
        $static = new self();

        return $static->constrained(Project::class);
    }

    public static function bySupervisor()
    {
        $static = new self();

        return $static->constrained(Supervisor::class);
    }

    public static function byNationality()
    {
        $static = new self();

        return $static->constrained(Nationality::class);
    }
    
    protected function constrained($class)
    {
        $class = new $class;

        return $class->withCount(['employees' =>  $this->constrainCallback()])
            ->whereHas('employees', $this->constrainCallback())->get();
    }

    protected function constrainCallback()
    {
        return  function($query) {
            return $query->actives()
            ->filter(request()->all());
        };
    }
}