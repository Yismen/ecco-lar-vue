<?php

namespace App\Http\Controllers\Payroll;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\Payrolls;
use App\Http\Controllers\Controller;
use App\Repositories\Payroll\PayrollCloser;
use App\Http\Requests\GeneratePayrollsRequest;

class GenerateController extends Controller
{
    private $payrolls;

    public function __construct(Payrolls $payrolls)
    {
        $this->payrolls = $payrolls;
    }


    function __construc()
    {
        
    }
    public function generate()
    {
        return view('payrolls.generate');
    }

    public function handleGenerate()
    {
        return $this->payrolls->all();
    }

    public function filter(GeneratePayrollsRequest $request)
    {
        return [
            'employees_with_hours' => $this->payrolls->employeesWithHours($request),
            'actives_without_hours' => $this->payrolls->activesWithoutHours($request),
        ];   
    }

    public function prepare()
    {
        return $this->payrolls->prepare();
    }

    public function filterPositionsByDepartment(Request $request)
    {
        if ($request->department) {
            return $this->payrolls->position
                ->where('department_id', 'like', $request->department)
                ->orderBy('department_id')->select('name', 'id', 'department_id')
                ->with('department')
                ->get();
        }
    }

    public function close(Request $request, Carbon $carbon, PayrollCloser $closer)
    {
        $this->validate($request, [
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'payment_date' => 'required|date',
            'activeEmployees' => 'required|array',
        ]);

        $closer = $closer->render($request);

        if ($closer->has_errors) {
            return response()->json("Errors", 401);
        }
        return response()->json("success", 200);



        foreach ($request->activeEmployees as $employee) {
            $employee = collect($employee);
            new PayrollCloser(
                $carbon->parse($request->from_date)->format('Y-m-d'),
                $carbon->parse($request->to_date)->format('Y-m-d'),
                $carbon->parse($request->payment_date)->format('Y-m-d'),
                $employee['data']
            );
        }
    }

}
