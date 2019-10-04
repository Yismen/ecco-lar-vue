<?php

namespace App\Http\Controllers;

use App\Vip;
use App\Employee;
use Illuminate\Http\Request;
use App\Repositories\Employees\VipRepo;

class VipController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-vips|edit-vips|create-vips', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-vips', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-vips', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-vips', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VipRepo $vips)
    {
        $vip_list = $vips->vips()->paginate(50);
        $no_vip_list = $vips->noVips()->get();

        return view('vips.index', compact('vip_list', 'no_vip_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Vip $vip)
    {
        $this->validate($request, [
            'employee_id' => 'required|exists:employees,id',
            'since' => 'required|date',
        ]);

        $employee = Employee::findOrFail($request->get('employee_id'));

        $vip = $vip->create($request->only('employee_id', 'since'));

        return redirect()
            ->route('admin.vips.index')
            ->withSuccess("Employee {$employee->full_name} is now a VIP member.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Vip $vip
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Vip $vip)
    {
        return view('vips.edit', compact('vip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Vip                 $vip
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vip $vip)
    {
        $this->validate($request, [
            'since' => 'required|date',
        ]);

        $vip->update($request->only('since'));

        return redirect()
            ->route('admin.vips.index')
            ->withSuccess("VIP {$vip->employee->full_name} Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Vip $vip
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vip $vip)
    {
        $vip->delete();

        if (request()->ajax()) {
            return $vip;
        }

        return redirect()->route('admin.vips.index')
            ->withDanger('Vip destroyed!');
    }
}
