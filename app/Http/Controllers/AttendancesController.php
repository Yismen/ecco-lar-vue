<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\Repositories\AttendanceRepository;
use App\User;

class AttendancesController extends Controller
{    
    protected $repo;

    protected $user;

    public function __construct()
    {
        $this->middleware('authorize:view-attendances|edit-attendances|create-attendances', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-attendances', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-attendances', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-attendances', ['only' => ['destroy']]);

        
        $this->repo = new AttendanceRepository;
        $this->user = User::find(auth()->user()->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = $this->repo->all();
        $employees = $this->user->load('supervisors.employees');
        
        return view('attendances.index', compact('attendances', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRequest $request)
    {
        $this->user->attendances()->create($request->all());
        
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
        return view('attendances.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AttendanceRequest  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(AttendanceRequest $request, Attendance $attendance)
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
