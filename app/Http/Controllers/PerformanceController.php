<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\PerformanceRepository;
use App\Http\Requests\Performance\CraetePerformance;
use App\Http\Requests\Performance\UpdatePerformance;

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
    public function index(PerformanceRepository $repo)
    {
        if (!request()->ajax()) {
            return view('performances.index');
        }

        return DataTables::of($repo->datatables())
            ->addColumn('dow', function ($query) {
                return route('admin.performances.show', $query->id);
            })
            ->addColumn('edit', function ($query) {
                return route('admin.performances.edit', $query->id);
            })
            ->toJson(true);
    }

    public function create(PerformanceRepository $repo, Performance $performance)
    {
        $recents = $repo->recents();

        return view('performances.create', compact('performance', 'recents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CraetePerformance $request, Performance $performance)
    {
        if ($exists = $this->exists($request)) {
            return redirect()->route('admin.performances.edit', $exists->id)
                ->withWarning('This data you tried to create exists already. You have been redirected to the edit page.');
        }

        $performance = $performance->createAsDowntime($request);

        return redirect()->route('admin.performances.create')
            ->withSuccess('Data Created! for '.$performance->name);
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
    public function update(UpdatePerformance $request, Performance $performance)
    {
        $performance->updateAsDowntime($request);

        return redirect()->back()
            ->withSuccess('Updated! '.$performance->name);
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
            ->orWhere('unique_id', $request->date.'-'.$request->employee_id.'-downtime')
            ->orWhere('unique_id', $request->date.'-'.$request->campaign_id.'-'.$request->campaign_id)
            ->first();
    }
}
