<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SupervisorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-supervisors|edit-supervisors|create-supervisors', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-supervisors', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-supervisors', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-supervisors', ['only' => ['destroy']]);
        $this->middleware('authorize:assign-supervisors-employees', ['only' => ['reAssign']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $free_employees = Employee::doesntHave('supervisor')
            ->orderBy('first_name')
            ->orderBy('second_first_name')
            ->orderBy('last_name')
            ->orderBy('second_last_name')
            ->actives()->with('position', 'project', 'nationality')
            ->get();

        $inactive_supervisors = Supervisor::orderBy('name')
            ->inactives()
            ->get();

        $supervisors = Supervisor::orderBy('name')
            ->with(['employees' => function ($query) {
                return $query->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name')
                    ->with('position', 'project', 'nationality')->actives();
            }])
            ->get();

        return view('supervisors.index', compact('supervisors', 'free_employees', 'inactive_supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Supervisor $supervisor)
    {
        $this->validate($request, [
            'name' => 'required|min:5|unique:supervisors,name',
        ]);

        Cache::forget('supervisors');
        Cache::forget('employees');

        $supervisor = $supervisor->create($request->only(['name']));

        if ($request->ajax()) {
            return $supervisor;
        }

        return redirect()->route('admin.supervisors.index')
            ->withSuccess("Supervisor $supervisor->name created!!");
    }

    /**
     * Display the specified resource.
     *
     * @param int  Supervisor $supervisor
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Supervisor $supervisor)
    {
        return view('supervisors.show', compact('supervisor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  Supervisor $supervisor
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Supervisor $supervisor)
    {
        return view('supervisors.edit', compact('supervisor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  Supervisor          $supervisor
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supervisor $supervisor)
    {
        if (!$request->has('active')) {
            $request->merge(['active' => '0']);
        }

        $this->validate(
            $request,
            [
                'name' => 'required|min:5|unique:supervisors,name,'.$supervisor->id,
                'active' => 'boolean',
            ]
        );

        Cache::forget('supervisors');
        Cache::forget('employees');

        $supervisor->update($request->only(['name', 'active']));

        return redirect()->route('admin.supervisors.index')
            ->withSuccess("Supervisor $supervisor->name Updated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  Supervisor $supervisor
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supervisor $supervisor, Request $request)
    {
        $supervisor->delete();

        Cache::forget('supervisors');
        Cache::forget('employees');

        if ($request->ajax()) {
            return $supervisor;
        }

        return redirect()->route('admin.supervisors.index')
            ->withDanger("Supervisor $supervisor->name have been eliminated!");
    }

    public function assignEmployees(Request $request)
    {
        $this->validate($request, [
            'employee' => 'required|array',
            'supervisor' => 'required|exists:supervisors,id',
        ], [
            'employee.required' => 'Select at least one employee!',
        ]);

        foreach ($request->employee as  $id) {
            $employee = Employee::whereId($id)->first();

            $employee->update(['supervisor_id' => $request->supervisor]);
        }

        return redirect()->route('admin.supervisors.index')
            ->withSuccess('Done!');
    }
}
