<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

abstract class CapillusBase
{
    protected $connection;

    public function __construct()
    {        
        $this->connection = DB::connection('poliscript');
    }
}