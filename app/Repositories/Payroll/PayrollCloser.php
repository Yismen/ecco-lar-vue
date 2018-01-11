<?php

namespace App\Repositories\Payroll;

use Carbon\Carbon;
use App\Payroll;

class PayrollCloser
{
    private $carbon;
    private $payroll_id;
    private $unique_id;
    private $from_date;
    private $to_date;
    private $payment_date;
    private $employee_id;
    private $employee;
    public $has_errors = false;

    public function render($request)
    {
        $this->carbon = new Carbon;

        $this->from_date = $this->carbon->parse($request->from_date)->format('Y-m-d');
        $this->to_date = $this->carbon->parse($request->to_date)->format('Y-m-d');
        $this->payment_date = $this->carbon->parse($request->payment_date)->format('Y-m-d');
        $this->employee = collect($request->activeEmployees)->toArray();

        return $this->close();
    }

    private function close()
    {
        foreach ($this->employee as $employee) {
            // return $employee;
            $employee = collect($employee['data']);

            $this->payroll_id = $this->carbon->parse($this->payment_date)->format("Ymd");
            $this->employee_id = $employee['identity']['id'];
            $this->unique_id = $this->payroll_id."-".$this->employee_id;
            $this->deleteIfExists();

            Payroll::create([
                'payroll_id'   => $this->payroll_id,
                'unique_id'    => $this->unique_id,
                'from_date'    => $this->from_date,
                'to_date'      => $this->to_date,
                'payment_date' => $this->payment_date,

                'employee_id' => $this->employee_id,
                'name' => $employee['identity']['full_name'],
                'pay_per_hours' => $employee['identity']['position']['pay_per_hours'],
                'position_id' => $employee['identity']['position']['id'],
                'payment_type_id' => $employee['identity']['position']['payment_type_id'],
                'payment_frequency_id' => $employee['identity']['position']['payment_frequency_id'],
                'department_id' => $employee['identity']['position']['department_id'],

                'regular_incomes' => $employee['salary']['regular'],
                'nightly_incomes' => $employee['salary']['nightly'],
                'holidays_incomes' => $employee['salary']['holiday'],
                'overtime_incomes' => $employee['salary']['overtime'],
                'training_incomes' => $employee['salary']['training'],
                'incentive_incomes' => $employee['other_incomes']['incentives'],
                'other_incomes' => $employee['other_incomes']['additionals'],

                'ars_discounts' => $employee['discounts']['ars'],
                'afp_discounts' => $employee['discounts']['afp'],
                'other_discounts' => $employee['discounts']['others'],

                'tss_payroll_incomes' => $employee['salary']['tss'],
                'gross_incomes' => $employee['salary']['gross'],
                'net_incomes' => $employee['salary']['net'],
                'payment_incomes' => $employee['salary']['payment']
            ]);
        }

        return $this;
    }

    private function deleteIfExists()
    {
        $exists = Payroll::where('unique_id', '=', $this->unique_id)->first();

        if ($exists) {
            $exists->delete();
        }
    }

}