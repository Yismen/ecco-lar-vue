<?php

namespace App\Repositories;

use App\Project;

class ProjectRepository
{
    protected function query()
    {
        return Project::orderBy('name');
    }

    public static function all()
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