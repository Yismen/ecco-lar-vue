<?php

namespace App\Http\Controllers;

use App\Universal;
use App\Employee;
use Illuminate\Http\Request;
use App\Repositories\Employees\UniversalRepo;

class UniversalController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-universals|edit-universals|create-universals', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-universals', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-universals', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-universals', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UniversalRepo $universals)
    {
        $universal_list = $universals->universals()->paginate(50);
        $no_universal_list = $universals->noUniversals()->get();

        return view('universals.index', compact('universal_list', 'no_universal_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Universal $universal)
    {
        $this->validate($request, [
            'employee_id' => 'required|exists:employees,id',
            'since' => 'required|date',
        ]);

        $employee = Employee::findOrFail($request->get('employee_id'));

        $universal = $universal->create($request->only('employee_id', 'since'));

        return redirect()
            ->route('admin.universals.index')
            ->withSuccess("Employee {$employee->full_name} is now a VIP member.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Universal $universal
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Universal $universal)
    {
        return view('universals.edit', compact('universal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Universal           $universal
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Universal $universal)
    {
        $this->validate($request, [
            'since' => 'required|date',
        ]);

        $universal->update($request->only('since'));

        return redirect()
            ->route('admin.universals.index')
            ->withSuccess("VIP {$universal->employee->full_name} Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Universal $universal
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Universal $universal)
    {
        $universal->delete();

        if (request()->ajax()) {
            return $universal;
        }

        return redirect()->route('admin.universals.index')
            ->withDanger('Universal destroyed!');
    }
}
