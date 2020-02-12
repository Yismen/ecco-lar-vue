<?php

namespace App\Http\Controllers\Attendance;

use App\AttendanceCode;
use App\Http\Controllers\Controller;
use App\Repositories\Attendances\AttendanceDatesCodesRepository;
use App\Repositories\Attendances\AttendanceDatesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function show(Request $request, $date)
    {
        $repo = new AttendanceDatesRepository(Carbon::parse($date));

        return view('attendances._by_date', ['codes' => $repo->data(), 'dates' => $repo->dates()]);
    }

    protected function employees($date, AttendanceCode $code)
    {
        $repo = new AttendanceDatesCodesRepository(Carbon::parse($date), $code->id);

        return view('attendances._by_date_code', ['employees' => $repo->data(), 'dates' => $repo->dates()]);
    }
}
