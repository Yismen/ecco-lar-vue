<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\Repositories\AttendanceRepository;

class AttendancesController extends Controller
{
    
    protected $repo;

    public function __construct()
    {
        $this->middleware('authorize:view-attendances|edit-attendances|create-attendances', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-attendances', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-attendances', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-attendances', ['only' => ['destroy']]);

        
        $this->repo = new AttendanceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = $this->repo->all();
        
        return view('attendances.index', compact('attendances'));
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
