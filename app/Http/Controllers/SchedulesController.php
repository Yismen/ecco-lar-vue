<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SchedulesController extends Controller
{
    /**
     * Apply restrictions to controller methods.
     */
    public function __construct()
    {
        $this->middleware('authorize:view-schedules', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-schedules', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-schedules', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-schedules', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            $employees_missing_schedule = Employee::actives()
                ->whereDoesntHave(
                    'schedules', function ($query) {
                        return $query->whereDate('date', '>=', Carbon::now()->subDays(10));
                    }
                )
                ->orderBy('first_name')
                ->orderBy('second_first_name')
                ->orderBy('last_name')
                ->paginate(25);

            return view('schedules.index', compact('employees_missing_schedule'));
        }

        $schedules = Schedule::whereHas('employee', function ($query) {
            return $query->actives();
        })
        ->with('employee')
        ->whereDate('date', '>=', Carbon::now()->subDays(10))
        ->orderBy('slug');

        return DataTables::of($schedules)
            ->orderColumn('employee', 'slug $1')
            ->toJson(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Schedule $schedule)
    {
        return view('schedules.create', compact('schedule'));
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
        $validated = $this->validate($request, [
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'days' => 'nullable|numeric|min:1|max:30',
        ]);

        $schedule = (new Schedule())->createNew($validated);

        return redirect()->route('admin.schedules.index')
            ->withSuccess('Schedules Created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Schedule $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Schedule $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $schedule = $schedule->load('employee');

        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Schedule            $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->validate($request, [
            'hours' => 'required|numeric|min:0|max:14',
        ]);

        $schedule = $schedule->update($request->only('hours'));

        return redirect()->route('admin.schedules.index')
            ->withSuccess('Schedule Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Schedule $schedule
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
    }
}
