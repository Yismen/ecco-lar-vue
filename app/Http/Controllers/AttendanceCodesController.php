<?php

namespace App\Http\Controllers;

use App\AttendanceCode;
use Illuminate\Http\Request;

class AttendanceCodesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('authorize:view-attendance-codes|edit-attendance-codes|create-attendance-codes', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-attendance-codes', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-attendance-codes', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-attendance-codes', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance_codes = AttendanceCode::orderBy('name')->get();

        return view('attendance_codes.index', compact('attendance_codes'));
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
            'name' => 'required|min:4|max:150|unique:attendance_codes,name',
            'color' => 'required|not_in:#000,#000000|unique:attendance_codes,color'
        ]);
        
        AttendanceCode::create($request->all());

        return redirect()
            ->route('admin.attendance_codes.index')
            ->withSuccess("Created!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttendanceCode  $attendanceCode
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceCode $attendanceCode)
    {
        return view('attendance_codes.edit', compact('attendanceCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttendanceCode  $attendanceCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendanceCode $attendanceCode)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:150|unique:attendance_codes,name,' . $attendanceCode->id,
            'color' => 'required|not_in:#000,#000000|unique:attendance_codes,color,' . $attendanceCode->id,
        ]);

        $attendanceCode->update($request->all());

        return redirect()
            ->route('admin.attendance_codes.edit', $attendanceCode->id)
            ->withWarning("Updated!");
    }
}
