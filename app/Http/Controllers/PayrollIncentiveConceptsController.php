<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\PayrollIncentiveConcept;

class PayrollIncentiveConceptsController extends Controller
{
    function __construct() {
        $this->middleware('authorize:view_payroll_incentive_concepts', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_payroll_incentive_concepts', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_payroll_incentive_concepts', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_payroll_incentive_concepts', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PayrollIncentiveConcept $concepts)
    {
        $concepts = $concepts->orderBy('name', 'ASC')->get();
        return view('payroll-incentive-concepts.index', compact('concepts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PayrollIncentiveConcept $concept)
    {
        return view('payroll-incentive-concepts.create', compact('concept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PayrollIncentiveConcept $concept)
    {
        $this->validate($request, [
            'name' => 'required|unique:payroll_incentive_concepts'
        ]);

        $concept = $concept->create($request->only('name'));

        return redirect()->route('admin.payroll-incentive-concepts.index')
            ->withSuccess("Concept {$concept->name} Created!");
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
    public function edit(PayrollIncentiveConcept $concept)
    {
        return view('payroll-incentive-concepts.edit', compact('concept'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayrollIncentiveConcept $concept)
    {
        $this->validate($request, [
            'name' => 'required|unique:payroll_incentive_concepts,name,'.$concept->id.',id'
        ]);

        $concept->update($request->only('name'));

        return redirect()->route('admin.payroll-incentive-concepts.edit', $concept->id)
            ->withSuccess("Concept {$concept->name} updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
