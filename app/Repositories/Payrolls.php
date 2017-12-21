<?php

namespace App\Repositories;

use App\Employee;
use App\Position;
use App\Department;
use App\PaymentType;
use App\PaymentFrequency;
use Illuminate\Http\Request;
use App\Repositories\Payroll\Parser;

class Payrolls
{
    public $employees;
    public $department;
    public $position;
    public $payment_type;
    private $payment_frequency;
    
    function __construct(Employee $employees, Department $department, Position $position, PaymentType $payment_type, PaymentFrequency $payment_frequency)
    {
        $this->employees = $employees;
        $this->department = $department;
        $this->position = $position;
        $this->payment_type = $payment_type;
        $this->payment_frequency = $payment_frequency;
    }

    public function all()
    {
        return $this->employees->take(5)->get();
    }

    private function filter(Request $request) 
    {
        return $this->employees
            ->orderBy('first_name')
            ->with(['payrollAdditionals' => function($query) use ($request) {
                return $query->whereBetween('date', [$request->from, $request->to]);
            }])
            ->with(['payrollDiscounts' => function($query) use ($request) {
                return $query->whereBetween('date', [$request->from, $request->to]);
            }])
            ->with(['payrollIncentives' => function($query) use ($request) {
                return $query->whereBetween('date', [$request->from, $request->to]);
            }])
            ->with(['position' => function ($query) {
                return $query->with('department', 'payment_type', 'payment_frequency');
            }])
            ->whereHas('position', function($query) use ($request) {
                return $query->where('id', 'like', $request->position)
                    ->whereHas('department', function($query) use ($request) {
                        return $query->where('id', 'like', $request->department);
                    })
                    ->whereHas('payment_type', function($query) use ($request) {
                        return $query->where('id', 'like', $request->payment_type);
                    })
                    ->whereHas('payment_frequency', function($query) use ($request) {
                        return $query->where('id', 'like', $request->payment_frequency);
                    });
            })
            ->with('hours');
    }

    public function employeesWithHours(Request $request)
    {
        return $this->filter($request)
            ->whereHas('hours', function($query)  use ($request) {
                return $query
                    // ->groupBy(['date', 'employee_id'])
                    ->whereBetween('date', [$request->from, $request->to])
                    // ->raw('*, sum(regulars) as sum_of_regulars')
                    ;
            })
            // ->take(25)
            ->get();

            return $this->parsePayroll($payrolls);
    }

    private function parsePayroll($payrolls)
    {
        $parser = new Parser;
        return $parser->parse($payrolls);
    }

    public function activesWithoutHours(Request $request)
    {
        return $this->filter($request)
            ->actives()
            ->whereDoesntHave('hours', function($query)  use ($request) {
                return $query
                    ->whereBetween('date', [$request->from, $request->to])
                    ;
            })
            ->take(5)
            ->get();
    }

    public function prepare()
    {
        return collect([
            'departments' => $this->department->orderBy('department')->select('department', 'id')->get(),
            'positions' => $this->position->orderBy('department_id')->select('name', 'id', 'department_id')->with('department')->get(),
            'payment_types' => $this->payment_type->orderBy('name')->select('name', 'id')->get(),
            'payment_frequencies' => $this->payment_frequency->orderBy('name')->select('name', 'id')->get(), 
        ]);
    }
}