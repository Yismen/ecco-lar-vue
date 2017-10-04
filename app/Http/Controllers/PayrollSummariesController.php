<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;
use App\PayrollSummary;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class PayrollSummariesController extends Controller
{
    private $data = [];
    private $file_errors = [];

    public function __construct() {
        $this->middleware('authorize:view_payrolls_summary|edit_payrolss_temp|create_payrolls_summary', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_payrolls_summary', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_payrolls_summary', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_payrolls_summary', ['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = PayrollSummary::groupBy('payroll_id')
            ->orderBy('payment_date', "DESC")
            ->paginate(45);

        return view('payrolls_summary.index', compact('dates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'payroll_file.*' => 'required|file|mimes:xls,xlsx,csv',
        ], ['payroll_file.*' => 'Este campo es requerido']);

        foreach ($request->file('payroll_file') as $file) {
            $validator = $this->ValidateFileName($file);

            if ($validator->fails()) {
                return redirect('admin/payrolls_summary')
                    ->withErrors($validator);
            }

            $this->loadDataFromExcelFile($file);

        }

        if (count($this->file_errors) > 0) {  
            $request->session()->flash('file_errors', ['errors'=>$this->file_errors]);    
            return redirect('admin/payrolls_summary')
                // ->withErrors($this->file_errors)
                ->withDanger('The file contains errors');
        }

        $this->saveDataToDB();

        return redirect('admin/payrolls_summary')
            ->withSuccess('The data was imported!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PayrollSummary $summary)
    {
        return view('payrolls_summary.show', compact('summary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 'Here';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'Here';
    }


    public function byPayrollID($payroll_id)
    {
        $payroll_summaries = PayrollSummary::with('employee.position.department')
            // ->orderBy('employee.first_name')
            ->where('payroll_id', $payroll_id)
            ->orderBy('name')
            ->get();

        return view('payrolls_summary.by_payroll_id_summary', compact('payroll_summaries', 'payroll_id'));
    }

    private function validateRow($data)
    {
            return Validator::make($data, 
                    [
                        'from_date' => 'required|date',
                        'to_date' => 'required|date',
                        'payment_date' => 'required|date',
                        'payroll_id' => 'required',
                        'unique_id' => 'required',
                        // 'unique_id' => 'required|unique:payroll_summaries',

                        'employee_id' => 'required|exists:employees,id',
                        'name' => 'required',

                        'regular_incomes' => 'required|numeric|min:0',
                        'nightly_incomes' => 'required|numeric|min:0',
                        'holidays_incomes' => 'required|numeric|min:0',
                        'overtime_incomes' => 'required|numeric|min:0',
                        'training_incomes' => 'required|numeric|min:0',

                        'incentive_incomes' => 'required|numeric|min:0',
                        'other_incomes' => 'required|numeric|min:0',

                        'tss_payroll_incomes' => 'required|numeric|min:0',
                        'gross_incomes' => 'required|numeric|min:0',
                        'net_incomes' => 'required|numeric|min:0',
                        'payment_incomes' => 'required|numeric|min:0',
                        
                        'ars_discounts' => 'required|numeric|min:0',
                        'afp_discounts' => 'required|numeric|min:0',
                        'other_discounts' => 'required|numeric|min:0',
                    ]
                );
    }

    private function loadDataFromExcelFile($file)
    {
        return Excel::load($file, function($reader) {
            foreach($reader->toArray() as $data){

                $validator = $this->validateRow($data);

                if ($validator->fails()) {
                    $message = $validator->messages();
                    $field_with_error = array_keys($message->getMessages());
                    $data = $validator->getData();

                    $this->file_errors[
                        explode(".", $reader->file->getClientOriginalName())[0]
                    ][] = [
                        'data' => $data,
                        'failed_field' => $field_with_error,
                        'error_messages' => $message->getMessages(),
                    ];
                } else {
                    $this->data[] = $data;
                }
            }
        });
    }

    private function ValidateFileName($file)
    {
         return Validator::make(
            [
                'file_name' => $file->getClientOriginalName()
            ], 
            [
                'file_name' => [
                    'required',
                    'regex:/(payroll_import)\w+/',
                ],
            ], [
                'regex' => 'No ha elegido el archivo correcto. Recuerde elegir un archivo de excel nombrado "payrol_import_##*"'
            ]
        );
    }

    private function saveDataToDB()
    {
        foreach ($this->data as $data) {
            $exists = PayrollSummary::where('unique_id', '=', $data['unique_id'])->first();

            if ($exists) {
                $exists->delete();
            }
            PayrollSummary::create($data);
        }
    }
}
