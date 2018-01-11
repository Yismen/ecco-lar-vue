<?php 

namespace App\Http\Controllers\Payroll;

use Validator;
use App\Http\Requests;
use App\Payroll;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\ExcelFileLoader;
use App\Http\Requests\PayrollImportFromExcelRequest;

class SummaryController extends Controller
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
        $dates = Payroll::groupBy('payroll_id')
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
    public function store(PayrollImportFromExcelRequest $request)
    {
        $loader = (new ExcelFileLoader([
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
        ]))->load($request->file('payroll_file'));

        if ($loader->hasErrors()) {  
            $request->session()->flash('file_errors', ['errors' => $loader->errors()]);    
            return redirect('admin/payrolls_summary')
                ->withDanger('The file contains errors');
        }

        $this->saveDataToDB($loader->data());

        return redirect('admin/payrolls_summary')
            ->withSuccess('The data was imported!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $summary)
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
        $payroll_summaries = Payroll::with('employee.position.department')
            // ->orderBy('employee.first_name')
            ->where('payroll_id', $payroll_id)
            ->orderBy('name')
            ->get();

        return view('payrolls_summary.by_payroll_id_summary', compact('payroll_summaries', 'payroll_id'));
    }

    private function saveDataToDB($rows)
    {
        foreach ($rows as $data) {
            $exists = Payroll::where('unique_id', '=', $data['unique_id'])->first();

            if ($exists) {
                $exists->delete();
            }
            Payroll::create($data);
        }
    }
}
