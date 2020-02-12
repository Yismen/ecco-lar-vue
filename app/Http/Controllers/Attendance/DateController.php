<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\App\Repositories\Attendances\ByDate;

class DateController extends Controller
{
    public function show(Request $request, $date)
    {
        // $this->validate($request, [
        //     'date' => 'required'
        // ]);
        
        $codes =  ByDate::data([
            'date' => $date,
            'user_id' => auth()->user()->id
        ]);

        $dates = ByDate::dates(['user_id' => auth()->user()->id]);

        return view('attendances._by_date', compact('codes', 'dates'));
    }
}
