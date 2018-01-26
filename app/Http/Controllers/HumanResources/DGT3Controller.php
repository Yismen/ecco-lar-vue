<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\HumanResources\Employees\Reports;

class DGT3Controller extends Controller
{
    public function dgt3()
    {
        return view('human_resources.reports.dgt3');
    }

    public function handleDgt3(Request $request, Reports $report)
    {
        $this->validate($request, [
            'year' => 'required|integer'
        ]);

        $results = $report->dgt3($request->year)->get();

        $request->flash();

        return view('human_resources.reports.dgt3', compact('results'));
    }

    public function dgt3ToExcel(Request $request, Reports $report)
    {
        $results = $report->dgt3($request->year)->get();

        $request->flash();

        Excel::create('DGT3-' . $request->year, function ($excel) use ($results) {
            $excel->sheet('DGT3', function ($sheet) use ($results) {
                $sheet->loadView('human_resources.reports.dgt3_results', compact('results'));
            });
        })->download('xlsx');

        // return view('human_resources.reports.dgt3', compact('results'));
    }
}
