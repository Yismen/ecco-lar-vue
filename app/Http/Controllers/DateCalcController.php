<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DateCalcController extends Controller
{
    protected $result;

    public function index()
    {
        return view('date_calc.index');
    }

    public function diffFromToday(Request $request, Carbon $carbon)
    {
        $this->validate($request, [
            'base_date' => 'required|date'
        ]);

        $result = $this->calcDiffFromToday($request, $carbon);

        if ($request->ajax()) {
            return view('date_calc._results', compact('result'));
        }

        return view('date_calc.index', compact('result'))->withInput('base_date');
    }

    public function rangeDiff(Request $request, Carbon $carbon)
    {
        $this->validate($request, [
            'from_date' => 'required|date|',
            'to_date' => 'required|date|',
        ]);

        $result = $this->calcDiffFromRange($request, $carbon);

        if ($request->ajax()) {
            return view('date_calc._results', compact('result'));
        }

        return view('date_calc.index', compact('result'))->withInput();
    }

    /**
     * Calculate the number of days from today.
     * @param  [object] $request Laravel request object
     * @param  [object] $carbon  Carbon instance
     * @return [int]          The number of days between today and the given date.
     */
    private function calcDiffFromToday($request, $carbon)
    {
        $today = $carbon->now();
        $date = $carbon->createFromFormat('Y-m-d', $request->input('base_date'));

        return $date->diffInDays($today, false);
    }

    /**
     * Calculate the number of days between two given dates.
     * @param  [object] $request Laravel request object
     * @param  [class] $carbon  Carbon instance
     * @return [int]          The number of days between the given dates
     */
    private function calcDiffFromRange($request, $carbon)
    {
        $from_date = $carbon->createFromFormat('Y-m-d', $request->input('from_date'));
        $to_date = $carbon->createFromFormat('Y-m-d', $request->input('to_date'));

        return $from_date->diffInDays($to_date, false);
    }
}
