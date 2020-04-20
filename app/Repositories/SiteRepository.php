<?php

namespace App\Repositories;

use App\Site;

class SiteRepository
{
    public $data;
    

    protected function query()
    {
        return Site::orderBy('name');
    }

    public function all()
    {
        $instance = new self();

        return $instance->query()->get();
    }

    public static function actives()
    {
        $instance = new self();
        return $instance->query()->whereHas('employees', function($query) {
            $query->actives();
        })->get();
    }
}