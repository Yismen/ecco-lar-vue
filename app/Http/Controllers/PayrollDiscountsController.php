<?php

namespace App\Http\Controllers;

use App\PayrollDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ExcelFileLoader;
use App\Http\Traits\PayrollDiscountsTrait;
use App\Http\Requests\PayrollDiscountRequest;

class PayrollDiscountsController extends Controller
{
    use PayrollDiscountsTrait;

    public function __construct()
    {
        $this->middleware('authorize:view_payroll-discounts', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_payroll-discounts', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_payroll-discounts', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_payroll-discounts', ['only' => ['destroy']]);
        $this->middleware('authorize:import_payrolls-discounts', ['only' => ['import', 'handleImport']]);
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
        $discount = $discount->create($request->only(['date', 'employee_id', 'discount_amount', 'concept_id', 'comment']));

        return redirect()->route('admin.payroll-discounts.index')
            ->withSuccess('Discount created!');
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
    public function update(PayrollDiscountRequest $request, PayrollDiscount $discount)
    {
        $discount->update($request->only(['date', 'employee_id', 'discount_amount', 'concept_id', 'comment']));

        return redirect()->route('admin.payroll-discounts.edit', $discount->id)
            ->withSuccess('Discount Updated!');
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
        $discounts = $discount->whereDate('date', '=', $date)
            ->select('*', DB::raw('sum(discount_amount) as discount_amount_sum'))
            ->groupBy('employee_id')
            ->orderBy('employee_id', 'ASC')
            ->with('employee')->paginate(50);

        return view('payroll-discounts.by-date', compact('discounts', 'date'));
    }

    public function import()
    {
        return view('payroll-discounts.import');
    }

    public function handleImport(Request $request)
    {
        $this->validate($request, [
            'discounts-file.*' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        $loader = (new ExcelFileLoader([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'discount_amount' => 'required|min:0',
            'concept_id' => 'required|exists:payroll_discount_concepts,id',
            'comment' => 'max:250',
        ]))
        ->load($request->file('discounts-file'));

        if ($loader->hasErrors()) {
            $request->session()->flash('file_errors', ['errors' => $loader->errors()]);
            return redirect()->route('admin.payroll-discounts.import')
                ->withDanger('The file contains errors');
        }

        $this->saveDataToDB($loader->data());

        return redirect()->route('admin.payroll-discounts.index')
            ->withSuccess('The data was imported!');
    }

    public function details($date, $employee_id, PayrollDiscount $discount)
    {
        $discounts = $discount->whereDate('date', '=', $date)
            ->where('employee_id', '=', $employee_id)
            ->orderBy('employee_id', 'ASC')
            ->with('employee.position.department')->paginate(50);

        return view('payroll-discounts.details', compact('discounts', 'date'));
    }
}
