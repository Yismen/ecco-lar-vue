<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\PerformancesImport;
use Maatwebsite\Excel\Facades\Excel;

class PerformanceController extends Controller
{
    /**
     * Protect the controller agaist unauthorized users
     */
    public function __construct()
    {
        $this->middleware('authorize:view-performances', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-performances', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-performances', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-performances', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $performances = Performance::orderBy('date', 'DESC')
            ->orderBy('campaign_id', 'DESC')
            ->groupBy(['date', 'campaign_id'])
            ->with('campaign.project')
            ->paginate(25);

        return view('performances.index', compact('performances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'excel_file' => 'required',
           'excel_file.*' => 'file|mimes:xls,xlsx',
        ]);

        foreach($request->file('excel_file') as $key => $file) {

            if(! Str::contains($file->getClientOriginalName(), '_performance_daily_data_')) {
                return redirect()->back()
                    ->withErrors(['excel_file' => "Wrong file selected. Please make sure you pick a file which the correct naming convention _performance_daily_data_..."]);
            }

            Excel::import(new PerformancesImport, $request->file('excel_file')[$key] );
        }

        return redirect()->route('admin.performances.index')
            ->withSuccess('Data Imported!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function show(Performance $performance, $perf_date)
    {
        $performances = $performance
            ->where('date', $perf_date)
            ->with('employee.supervisor')
            ->with('campaign.project')
            ->paginate(50);

        return view('performances.show', compact('performances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $performance)
    {
        return view('performances.edit', compact('performance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Performance $performance)
    {
        $this->validate($request, [
          'employee_id' => 'required|exists:employees,id',
          'supervisor_id' => 'required|exists:supervisors,id',
          'login_time' => 'required|numeric|min:0|max:14',
          'production_time' => 'required|numeric|min:0|max:14',
          'transactions' => 'required|numeric',
          'revenue' => 'required|numeric',
        ]);

        $performance->update(
            $request->only(['employee_id', 'supervisor_id', 'login_time', 'production_time', 'transactions', 'revenue'])
        );

        return redirect()->back()
            ->withSuccess("Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance, $date = null, $campaign_id = null)
    {
        if ($date && $campaign_id) {
            return $this->wantsMassDelete($performance, $date, $campaign_id);
        }

        $performance->delete();

        return $performance;

    }

    private function wantsMassDelete(Performance $performance, $date, $campaign_id)
    {
        $performances =  $performance
            ->where('date', $date)
            ->where('campaign_id', $campaign_id)
            ->get();

        foreach ($performances as $performance) {
            $performance->delete();
        }

        return $performances;
    }
}
