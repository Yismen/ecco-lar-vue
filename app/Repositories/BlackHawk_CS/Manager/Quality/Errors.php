<?php

namespace App\Repositories\BlackHawk_CS\Manager\Quality;

use App\Repositories\BlackHawk_CS\Manager\Quality\Errors\Monthly;
use App\Repositories\BlackHawk_CS\Manager\Quality\Errors\Weekly;

class Errors
{
    public $monthly = [];
    public $weekly = [];

    private $request;

    public function __construct()
    {
        $this->monthly = $this->monthly();
        $this->weekly = $this->weekly();
    }

    private function monthly()
    {
        return new Monthly;
    }

    private function weekly()
    {
        return new Weekly();
    }
}
