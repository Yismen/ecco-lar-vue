<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Requests\Attendance\CreateAttendanceRequest;
use App\Http\Requests\Attendance\EditAttendanceRequest;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class AttendancesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-attendances|edit-attendances|create-attendances', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-attendances', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-attendances', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-attendances', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attendance $attendance)
    {
        if (! request()->ajax()) {
            return view('attendances.index', compact('attendance'));
        }

        return DataTables::of(auth()->user()->attendances()->with('employee', 'attendance_code'))
            ->toJson(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()
            ->route('admin.attendances.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\Attendance\CreateAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttendanceRequest $request)
    {
        Cache::flush();

        foreach ($request->employee_id as $id) {
            $newAttendance = array_merge($request->all(), ['employee_id' => $id]);
            
            $exists = Attendance::whereDate('date', $newAttendance['date'])
                // ->where('code_id', $newAttendance['code_id'])
                ->where('employee_id', $newAttendance['employee_id'])
                ->first();

            if (! $exists) {
                // $exists->delete();

                auth()->user()
                    ->attendances()
                    ->create($newAttendance);
            }
        }
        
        
        return redirect()
            ->route('admin.attendances.index')
            ->withSuccess("Attendance Created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\Attendance\CreateAttendanceRequest  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(EditAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return redirect()
            ->route('admin.attendances.index')
            ->withSuccess("Attendance Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('admin.attendances.index')
            ->withDanger("Attendance Removed!");
    }
}
