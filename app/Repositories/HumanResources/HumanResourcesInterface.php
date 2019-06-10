<?php

namespace App\Repositories\HumanResources;

interface HumanResourcesInterface
{
    public function setup();

    public function count();

    public function list();
}
