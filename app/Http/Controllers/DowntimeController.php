<?php

namespace App\Http\Controllers;

use App\Performance;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\PerformanceRepository;
use App\Http\Requests\Performance\UpdateDowntimeRequest;
use App\Http\Requests\Performance\CreateDowntimeRequest;

class DowntimeController extends Controller
{
    protected $imported_files = [];

    /**
     * Protect the controller agaist unauthorized users.
     */
    public function __construct()
    {
        $this->middleware('authorize:view-downtimes', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-downtimes', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-downtimes', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-downtimes', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PerformanceRepository $repo)
    {
        return redirect()
            ->route('admin.downtimes.create');
    }

    public function create(PerformanceRepository $repo, Performance $downtime)
    {
        if (!request()->ajax()) {
            return view('downtimes.create', compact('downtime'));
        }

        return DataTables::of($repo->downtimes())
            ->toJson(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDowntimeRequest $request, Performance $downtime)
    {
        if ($exists = $this->exists()) {
            return redirect()->route('admin.downtimes.edit', $exists->id)
                ->withWarning('This data you tried to create exists already. You have been redirected to the edit page.');
        }

        $downtime = $downtime->create($request->all());

        return redirect()->route('admin.downtimes.create')
            ->withSuccess('Data Created! for ' . $downtime->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Performance $downtimes
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $downtime)
    {
        return view('downtimes.edit', compact('downtime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Performance         $downtime
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDowntimeRequest $request, Performance $downtime)
    {
        $downtime->update($request->all());

        return redirect()->back()
            ->withSuccess('Updated! ' . $downtime->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Performance $downtime
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $downtime)
    {
        $downtime->delete();

        return ['status' => 'sucess', 'message' => 'Performance Data Deleted', 'data' => $downtime];
    }

    private function exists()
    {
        return Performance::whereDate('date', request()->date)
            ->where('employee_id', request()->employee_id)
            ->where('campaign_id', request()->campaign_id)
            ->orWhere('unique_id', request()->date . '-' . request()->employee_id . '-downtime')
            ->orWhere('unique_id', request()->date . '-' . request()->campaign_id . '-' . request()->campaign_id)
            ->first();
    }
}
