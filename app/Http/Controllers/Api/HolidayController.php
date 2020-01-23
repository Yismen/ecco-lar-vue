<?php

namespace App\Http\Controllers\Api;

use App\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HolidayResource;
use Carbon\Carbon;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::whereYear('date', Carbon::now()->year)
            ->orWhereYear('date', Carbon::now()->subYear()->year)
            ->get();

        return HolidayResource::collection($holidays);
    }
}
