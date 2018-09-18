<?php

namespace App\Repositories;

use App\Employee;
use App\Position;
use Carbon\Carbon;
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
    private $carbon;

    public function __construct(Employee $employees, Department $department, Position $position, PaymentType $payment_type, PaymentFrequency $payment_frequency, Carbon $carbon)
    {
        $this->employees = $employees;
        $this->department = $department;
        $this->position = $position;
        $this->payment_type = $payment_type;
        $this->payment_frequency = $payment_frequency;
        $this->carbon = $carbon;
    }

    public function all()
    {
        return $this->employees->take(5)->get();
    }

    private function filter(Request $request)
    {
        $from = $this->carbon->parse($request->from)->format('Y-m-d');
        $to = $this->carbon->parse($request->to)->format('Y-m-d');

        return $this->employees
            ->orderBy('first_name')
            ->with(['payrollAdditionals' => function ($query) use ($request) {
                return $query->whereBetween('date', [$request->from, $request->to]);
            }])
            ->with(['payrollDiscounts' => function ($query) use ($request) {
                return $query->whereBetween('date', [$request->from, $request->to]);
            }])
            ->with(['payrollIncentives' => function ($query) use ($request) {
                return $query->whereBetween('date', [$request->from, $request->to]);
            }])
            ->with(['position' => function ($query) {
                return $query->with('department', 'payment_type', 'payment_frequency');
            }])
            ->whereHas('position', function ($query) use ($request) {
                return $query->where('id', 'like', $request->position)
                    ->whereHas('department', function ($query) use ($request) {
                        return $query->where('id', 'like', $request->department);
                    })
                    ->whereHas('payment_type', function ($query) use ($request) {
                        return $query->where('id', 'like', $request->payment_type);
                    })
                    ->whereHas('payment_frequency', function ($query) use ($request) {
                        return $query->where('id', 'like', $request->payment_frequency);
                    });
            })
            ->with(['hours' => function ($query) use ($from, $to) {
                return $query
                    ->whereDate('date', '>=', $from)
                    ->whereDate('date', '<=', $to);
            }]);
    }

    public function employeesWithHours(Request $request)
    {
        $from = $this->carbon->parse($request->from)->format('Y-m-d');
        $to = $this->carbon->parse($request->to)->format('Y-m-d');

        return [
            'from' => $request->from,
            'to' => $request->to,
            'data' => $this->filter($request)
                ->whereHas('hours', function ($query) use ($request, $from, $to) {
                    return $query
                        ->whereDate('date', '>=', $from)
                        ->whereDate('date', '<=', $to);
                })
                ->get(),
            ];

        return $this->filter($request)
            ->whereHas('hours', function ($query) use ($request) {
                return $query
                    ->whereBetween('date', [$request->from, $request->to]);
            })
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
        $from = $this->carbon->parse($request->from)->format('Y-m-d');
        $to = $this->carbon->parse($request->to)->format('Y-m-d');

        return $this->filter($request)
            ->actives()
            ->whereDoesntHave('hours', function ($query) use ($request, $from, $to) {
                return $query
                    ->whereDate('date', '>=', $from)
                    ->whereDate('date', '<=', $to);
            })
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
