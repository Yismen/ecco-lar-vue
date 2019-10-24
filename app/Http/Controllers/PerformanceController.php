<?php

namespace App\Http\Controllers;

use App\Performance;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\PerformanceRepository;
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
            ->toJson(true);
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
        $performance->update($request->all());

        return redirect()->back()
            ->withSuccess('Updated! ' . $performance->name);
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
}
