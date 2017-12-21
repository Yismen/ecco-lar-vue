<?php

namespace App\Repositories\Payroll;

class Parser 
{
    private $nightly;
    private $holiday;
    private $overtime;
    private $training;

    public function __construct($nightly = 0.15, $holiday = 1, $overtime = 0.35, $training = 0.5)
    {
        $this->nightly = $nightly;
        $this->holiday = $holiday;
        $this->overtime = $overtime;
        $this->training = $training;
    }


    public function parse($payrolls)
    {
        return array_map(function($payroll) {
            return [
                'id' => $payroll['id'],
                'name' => trim($payroll['full_name']),
                'position' => trim($payroll['position']['name_and_department']),
                'payment_type' => trim($payroll['position']['payment_type']['name']),
                'payment_frequency' => trim($payroll['position']['payment_frequency']['name']),
                'pay_per_hours' => $payroll['position']['pay_per_hours'],
                'regular_incomes' => $payroll['position']['pay_per_hours'],
                'nightly_incomes' => $payroll['position']['pay_per_hours'],
                'overtime_incomes' => $payroll['position']['pay_per_hours'],
                'holiday_incomes' => $payroll['position']['pay_per_hours'],
                'training_incomes' => $payroll['position']['pay_per_hours'],

            ];
        }, $payrolls->toArray());
    }
}