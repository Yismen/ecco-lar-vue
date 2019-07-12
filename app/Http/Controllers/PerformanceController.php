<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PerformanceController extends Controller
{
    protected $imported_files = [];

    /**
     * Protect the controller agaist unauthorized users.
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
        if (!request()->ajax()) {
            return view('performances.index');
        }

        $performances = Performance::with(
            ['campaign.project', 'supervisor', 'employee.supervisor']
        );

        return DataTables::of($performances)
            ->addColumn('dow', function ($query) {
                return route('admin.performances.show', $query->id);
            })
            ->addColumn('edit', function ($query) {
                return route('admin.performances.edit', $query->id);
            })
            ->toJson(true);
    }

    public function create(Performance $performance)
    {
        return view('performances.create', compact('performance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // It is like Create downtimes
        $this->validate($request, [
            'date' => 'required|date|',
            'employee_id' => 'required|exists:employees,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'login_time' => 'required|numeric|min:0|max:14',
            'downtime_reason_id' => 'required|exists:downtime_reasons,id',
            'reported_by' => 'required|exists:supervisors,name',
        ]);

        if ($exists = $this->exists($request)) {
            return redirect()->route('admin.performances.edit', $exists->id)
                ->withWarning('This data you tried to create exists already. You have been redirected to the edit page.');
        }

        $pperformance = (new Performance())->createManually($request);

        return redirect()->route('admin.performances.index')
            ->withSuccess('Data Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Performance $performance
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Performance $performance)
    {
        return view('performances.show', compact('performance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Performance $performances
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $performance)
    {
        return view('performances.edit', compact('performance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Performance         $performance
     *
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
            ->withSuccess('Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Performance $performance
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        $performance->delete();

        return ['status' => 'sucess', 'message' => 'Performance Data Deleted', 'data' => $performance];
    }

    private function exists(Request $request)
    {
        return Performance::whereDate('date', $request->date)
            ->where('employee_id', $request->employee_id)
            ->where('campaign_id', $request->campaign_id)
            ->first();
    }
}
