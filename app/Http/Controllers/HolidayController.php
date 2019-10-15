<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Http\Requests\Holiday\CreateHolidayRequest;
use App\Http\Requests\Holiday\UpdateHolidayRequest;
use Yajra\DataTables\Facades\DataTables;

class HolidayController extends Controller
{
    /**
     * Protect against unauthorized users
     */
    public function __construct()
    {
        $this->middleware('authorize:view-holidays|edit-holidays|create-holidays', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-holidays', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-holidays', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-holidays', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view('holidays.index', compact('employees'));
        }

        return DataTables::of(Holiday::sinceManyMonthsAgo(6))
            ->toJson(true);
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
     * @param  \Illuminate\Http\HolidayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHolidayRequest $request)
    {
        $holiday = Holiday::create($request->all());

        return redirect()->route('admin.holidays.index')
            ->withSuccess("Holiday for {$holiday->name}, on {$holiday->date} created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        return view('holidays.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Holiday\CreateHolidayRequest  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        $holiday->update($request->all());

        return redirect()->route('admin.holidays.edit', $holiday->id)
            ->withWarning("Holiday for {$holiday->name}, on {$holiday->date} updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        
        return redirect()->route('admin.holidays.index')
            ->withWarning("Holiday for {$holiday->date} deleted!");
    }
}
