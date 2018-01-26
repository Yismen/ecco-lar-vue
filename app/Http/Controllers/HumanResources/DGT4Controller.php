<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\HumanResources\Employees\Reports;
use Maatwebsite\Excel\Facades\Excel;

class DGT4Controller extends Controller
{
    public function dgt4()
    {
        return view('human_resources.reports.dgt4');
    }

    public function handleDgt4(Request $request, Reports $report)
    {
        $this->validate($request, [
            'year' => 'required|integer',
            'month' => 'required|integer|between:1,12',
            ]);

        $results = $report->dgt4($request->year, $request->month)->get();

        $request->flash();

        return view('human_resources.reports.dgt4', compact('results'));
    }

    public function dgt4ToExcel(Request $request, Reports $report)
    {
        $results = $report->dgt4($request->year, $request->month)->get();

        $request->flash();

        Excel::create('DGT4-' . $request->year, function ($excel) use ($results) {
            $excel->sheet('DGT4', function ($sheet) use ($results) {
                $sheet->loadView('human_resources.reports.dgt4_results', compact('results'));
            });
        })->download('xlsx');
    }
}
