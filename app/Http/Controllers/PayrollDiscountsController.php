<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PayrollDiscount;
use Illuminate\Http\Request;
use App\Http\Requests\PayrollDiscountRequest;

class PayrollDiscountsController extends Controller
{
    function __construct() {
        $this->middleware('authorize:view_payroll-discounts', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_payroll-discounts', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_payroll-discounts', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_payroll-discounts', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PayrollDiscount $discounts)
    {
        $dates = $discounts->groupBy('date')->orderBy('date', 'DESC')->paginate(30);

        return view('payroll-discounts.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PayrollDiscount $discount)
    {
        return view('payroll-discounts.create', compact('discount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollDiscountRequest $request, PayrollDiscount $discount)
    {
        $discount = $discount->create($request->only(['date', 'employee_id', 'amount', 'concept_id', 'comment']));

        return redirect()->route('admin.payroll-discounts.index')
            ->withSuccess("Discount created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  PayrollDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function show(PayrollDiscount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  PayrollDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(PayrollDiscount $discount)
    {
        return view('payroll-discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  PayrollDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayrollDiscount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  PayrollDiscount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayrollDiscount $discount)
    {
        //
    }

    public function byDate($date, PayrollDiscount $discount)
    {
        $discounts =  $discount->whereDate('date', '=', $date)
            // ->orderBy(function($query) {
            //     $query;
            // })
            ->with('employee')->paginate(50);

        return view('payroll-discounts.by-date', compact('discounts', 'date'));
    }
}
