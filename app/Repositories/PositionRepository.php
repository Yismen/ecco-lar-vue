<?php

namespace App\Repositories;

use App\Position;

class PositionRepository
{
    protected function query()
    {
        return Position::orderBy('name');
    }

    public static function all()
    {
        $instance = new self();

        return $instance->query()->get();
    }

    public static function actives()
    {
        return $this->query()->whereHas('employees', function($query) {
            return $query->actives();
        });
    }
}