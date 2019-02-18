<?php

namespace App\Http\Controllers;

use DB;
use App\PayrollIncentive;
use Illuminate\Http\Request;
use App\Repositories\ExcelFileLoader;
use App\Http\Traits\PayrollIncentivesTrait;
use App\Http\Requests\PayrollIncentiveRequest;

class PayrollIncentivesController extends Controller
{
    use PayrollIncentivesTrait;

    public function __construct()
    {
        $this->middleware('authorize:view-payroll-incentives', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-payroll-incentives', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-payroll-incentives', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-payroll-incentives', ['only' => ['destroy']]);
        $this->middleware('authorize:import-payrolls-incentives', ['only' => ['import', 'handleImport']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PayrollIncentive $incentives)
    {
        $dates = $incentives->groupBy('date')->orderBy('date', 'DESC')->paginate(30);

        return view('payroll-incentives.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PayrollIncentive $incentive)
    {
        return view('payroll-incentives.create', compact('incentive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollIncentiveRequest $request, PayrollIncentive $incentive)
    {
        $incentive = $incentive->create($request->only(['date', 'employee_id', 'incentive_amount', 'concept_id', 'comment']));

        return redirect()->route('admin.payroll-incentives.index')
            ->withSuccess('Incentive created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  PayrollIncentive $incentive
     * @return \Illuminate\Http\Response
     */
    public function show(PayrollIncentive $incentive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  PayrollIncentive $incentive
     * @return \Illuminate\Http\Response
     */
    public function edit(PayrollIncentive $incentive)
    {
        return view('payroll-incentives.edit', compact('incentive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  PayrollIncentive $incentive
     * @return \Illuminate\Http\Response
     */
    public function update(PayrollIncentiveRequest $request, PayrollIncentive $incentive)
    {
        $incentive->update($request->only(['date', 'employee_id', 'incentive_amount', 'concept_id', 'comment']));

        return redirect()->route('admin.payroll-incentives.edit', $incentive->id)
            ->withSuccess('Incentive Income Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  PayrollIncentive $incentive
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayrollIncentive $incentive)
    {
        //
    }

    public function byDate($date, PayrollIncentive $incentive)
    {
        $incentives = $incentive->whereDate('date', '=', $date)
            ->select('*', DB::raw('sum(incentive_amount) as incentive_amount_sum'))
            ->groupBy('employee_id')
            ->orderBy('employee_id', 'ASC')
            ->with('employee.position.department')->paginate(50);

        return view('payroll-incentives.by-date', compact('incentives', 'date'));
    }

    public function import()
    {
        return view('payroll-incentives.import');
    }

    public function handleImport(Request $request)
    {
        $this->validate($request, [
            'incentives-file.*' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        $loader = (new ExcelFileLoader([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'incentive_amount' => 'required|min:0',
            'concept_id' => 'required|exists:payroll_discount_concepts,id',
            'comment' => 'max:250',
        ]))
        ->load($request->file('incentives-file'));

        if ($loader->hasErrors()) {
            $request->session()->flash('file_errors', ['errors' => $loader->errors()]);
            return redirect()->route('admin.payroll-incentives.import')
                ->withDanger('The file contains errors');
        }

        $this->saveDataToDB($loader->data());

        return redirect()->route('admin.payroll-incentives.index')
            ->withSuccess('The data was imported!');
    }

    public function details($date, $employee_id, PayrollIncentive $incentive)
    {
        $incentives = $incentive->whereDate('date', '=', $date)
            ->where('employee_id', '=', $employee_id)
            ->orderBy('employee_id', 'ASC')
            ->with('employee.position.department')->paginate(50);

        return view('payroll-incentives.details', compact('incentives', 'date'));
    }
}
