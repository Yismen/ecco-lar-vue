<?php

namespace App\Repositories\BlackHawk_CS\Supervisor\Quality;

use App\Repositories\BlackHawk_CS\Supervisor\Quality\Errors\Monthly;
use App\Repositories\BlackHawk_CS\Supervisor\Quality\Errors\Weekly;
use Illuminate\Http\Request;

class Errors
{
    public $monthly = [];
    public $weekly = [];

    public function __construct(Request $request)
    {
        $this->weekly = new Weekly($request);
        $this->monthly = new Monthly($request);
    }
}
