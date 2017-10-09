<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PayrollAdditional;
use Illuminate\Http\Request;
use App\Http\Requests\PayrollAdditionalRequest;

class PayrollAdditionalsController extends Controller
{
    function __construct() {
        $this->middleware('authorize:view_payroll-additionals', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_payroll-additionals', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_payroll-additionals', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_payroll-additionals', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PayrollAdditional $additionals)
    {
        $dates = $additionals->groupBy('date')->orderBy('date', 'DESC')->paginate(30);

        return view('payroll-additionals.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PayrollAdditional $additional)
    {
        return view('payroll-additionals.create', compact('additional'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollAdditionalRequest $request, PayrollAdditional $additional)
    {
        $additional = $additional->create($request->only(['date', 'employee_id', 'amount', 'concept_id', 'comment']));

        return redirect()->route('admin.payroll-additionals.index')
            ->withSuccess("Additional created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  PayrollAdditional $additional
     * @return \Illuminate\Http\Response
     */
    public function show(PayrollAdditional $additional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  PayrollAdditional $additional
     * @return \Illuminate\Http\Response
     */
    public function edit(PayrollAdditional $additional)
    {
        return view('payroll-additionals.edit', compact('additional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  PayrollAdditional $additional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayrollAdditional $additional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  PayrollAdditional $additional
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayrollAdditional $additional)
    {
        //
    }

    public function byDate($date, PayrollAdditional $additional)
    {
        $additionals =  $additional->whereDate('date', '=', $date)
            // ->orderBy(function($query) {
            //     $query;
            // })
            ->with('employee')->paginate(50);

        return view('payroll-additionals.by-date', compact('additionals', 'date'));
    }

}
