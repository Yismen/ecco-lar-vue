<?php

namespace App\Http\Controllers;

use App\Employee;
use App\OvernightHour;
use Illuminate\Http\Request;
use App\Repositories\OvernightHourRepo;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\OvernightHour\CreateOvernightHourRequest;
use App\Http\Requests\OvernightHour\UpdateOvernightHourRequest;

class OvernightHourController extends Controller
{


    /**
     * Protect the controller agaist unauthorized users.
     */
    public function __construct()
    {
        $this->middleware('authorize:view-overnight-hours', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-overnight-hours', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-overnight-hours', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-overnight-hours', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OvernightHourRepo $overnight_repo)
    {

        if (!request()->ajax()) {
            $employees = $overnight_repo->employees()->get();

            return view('overnight-hours.index', compact('employees'));
        }

        $overnight_hours =  $overnight_repo->all();

        return DataTables::of($overnight_hours)
            ->toJson(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOvernightHourRequest $request)
    {
        OvernightHour::create($request->only(['date', 'employee_id', 'hours']));

        return redirect(route('admin.overnight_hours.index'))
            ->withSucess('Overnight hours created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OvernightHour  $overnightHour
     * @return \Illuminate\Http\Response
     */
    public function edit(OvernightHour $overnightHour)
    {
        return view('overnight-hours.edit', compact('overnightHour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OvernightHour  $overnightHour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOvernightHourRequest $request, OvernightHour $overnightHour)
    {
        $overnightHour->update($request->only(['hours']));

        return redirect()->route('admin.overnight_hours.edit', $overnightHour->id)
            ->withSuccess("Updated {$overnightHour->employee->full_name}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OvernightHour  $overnightHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(OvernightHour $overnightHour)
    {
        $overnightHour->delete();

        return redirect()->route('admin.overnight_hours.index')
            ->withSucess('Gone bye bye forerer!!!');
    }
}
