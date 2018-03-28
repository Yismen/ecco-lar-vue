<?php

namespace App\Http\Controllers\BlackHawkCS;

use App\Http\Controllers\Controller;
use App\Repositories\BlackHawk_CS\Statistic;

class StatisticController extends Controller
{
    public function index(Statistic $statistics)
    {
        return view('blackhawk-cs.statistic.index', compact('statistics'));
    }
}
