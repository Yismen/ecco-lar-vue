<?php

namespace App\Http\Controllers;

use App\Hour;
use App\Employee;
use Illuminate\Http\Request;

class HoursController extends Controller
{
    private $request;
    private $hours;

    public function __construct(Request $request, Hour $hours)
    {
        $this->request = $request;
        $this->hours = $hours;

        $this->middleware('authorize:view-hours|edit-hours|create-hours', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-hours', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-hours', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-hours', ['only' => ['destroy']]);
        $this->middleware('authorize:view-by-date', ['only' => ['byDate']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = $this->hours->select(['date'])
            ->orderBy('date', 'DESC')->groupBy('date')->paginate(20);

        return view('hours.index')
            ->with(['dates' => $dates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::actives()->pluck('first_name', 'last_name', 'id');

        return view('hours.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hour $hour)
    {
        // $employees = Employee::actives()->pluck('first_name', 'last_name', 'id');

        return view('hours.edit', compact('hour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hour $hour)
    {
        $this->validate($request, [
            'regulars' => 'required|numeric|min:0|max:21',
            'nightly' => 'required|numeric|min:0|max:' . $request->regulars,
            'holidays' => 'required|numeric|min:0|max:21',
            'training' => 'required|numeric|min:0|max:21',
            'overtime' => 'required|numeric|min:0|max:21',
        ]);

        $hour->update($request->only(['regulars', 'nightly', 'holidays', 'training', 'overtime']));

        return redirect()->route('admin.hours.edit', $hour->id)
            ->withSuccess('Hours Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hour $hour)
    {
        $hour->delete();

        return redirect()->route('admin.hours.index')
            ->withDanger('Removed hours for date ' . $hour->date->format('M/d/Y') . ', for employee ' . $hour->employee->full_name);
    }

    public function byDate($date)
    {
        $hours = $this->hours->whereDate('date', '=', $date)->with('employee.position.department')->paginate(50);

        return view('hours.by-date', compact('date', 'hours'));
    }
}
