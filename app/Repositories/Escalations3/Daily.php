<?php

namespace App\Repositories\Escalations3;

use App\Repositories\Escalations3\Production;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Daily extends Production
{

    static public function today()
    {
        return static::manyAgo(0);
    }

    static public function yesterday()
    {
        return static::manyAgo(1);
    }

    static public function manyAgo($ago = 0)
    {
        $date = (new Carbon)->subDays($ago);

        return static::render()
            ->where(DB::raw('YEAR(escal_records.insert_date)'), '=', $date->year)
            ->where(DB::raw('DATE(escal_records.insert_date)'), '=', $date->format('Y-m-d'));
    }    
    
    static private function query($year, $is)
    {
        return static::render();
    }
}