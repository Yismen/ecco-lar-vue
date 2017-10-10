<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PayrollAdditional;
use Illuminate\Http\Request;
use App\Repositories\ExcelFileLoader;
use App\Http\Traits\PayrollAdditionalsTrait;
use App\Http\Requests\PayrollAdditionalRequest;

class PayrollAdditionalsController extends Controller
{
    use PayrollAdditionalsTrait;

    function __construct() {
        $this->middleware('authorize:view_payroll-additionals', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_payroll-additionals', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_payroll-additionals', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_payroll-additionals', ['only'=>['destroy']]);
        $this->middleware('authorize:import_payrolls-additionals', ['only'=>['import', 'handleImport']]);
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
        $additional = $additional->create($request->only(['date', 'employee_id', 'additional_amount', 'concept_id', 'comment']));

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
    public function update(PayrollAdditionalRequest $request, PayrollAdditional $additional)
    {
        $additional->update($request->only(['date', 'employee_id', 'additional_amount', 'concept_id', 'comment']));

        return redirect()->route('admin.payroll-additionals.edit', $additional->id)
            ->withSuccess("Additional Income Updated!");
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
            ->orderBy('employee_id', 'ASC')
            ->with('employee')->paginate(50);

        return view('payroll-additionals.by-date', compact('additionals', 'date'));
    }

    public function import()
    {
        return view('payroll-additionals.import');
    }

    public function handleImport(Request $request)
    {
        $this->validate($request, [
            'additionals-file.*' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        $loader = (new ExcelFileLoader([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'additional_amount' => 'required|min:0',
            'concept_id' => 'required|exists:payroll_discount_concepts,id',
            'comment' => 'max:250',
        ]))
        ->load($request->file('additionals-file'));
        
        if ($loader->hasErrors()) {
            $request->session()->flash('file_errors', ['errors'=>$loader->errors()]); 
            return redirect()->route('admin.payroll-additionals.import')
                ->withDanger('The file contains errors');
        }

        $this->saveDataToDB($loader->data());

        return redirect()->route('admin.payroll-additionals.index')
            ->withSuccess('The data was imported!');
    }

}
