<?php

namespace App\Repositories;

use App\Department;

class DepartmentRepository
{
    protected function query()
    {
        return Department::orderBy('name');
    }

    protected static function all()
    {        
        $instance = new self();

        return $instance->query()->get();
    }

    public static function actives()
    {        
        $instance = new self();

        return $instance->query()->whereHas('employees', function($query) {
            return $query->actives();
        })->get();
    }
}