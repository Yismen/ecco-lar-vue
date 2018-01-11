<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    /**
     * mass assignable
     */
    protected $fillable = ['payroll_id', 'unique_id', 'from_date', 'to_date', 'payment_date', 'employee_id', 'name', 'pay_per_hours', 'position_id', 'payment_type_id', 'payment_frequency_id', 'department_id', 'regular_incomes', 'nightly_incomes', 'holidays_incomes', 'overtime_incomes', 'training_incomes', 'incentive_incomes', 'other_incomes', 'ars_discounts', 'afp_discounts', 'other_discounts', 'tss_payroll_incomes', 'gross_incomes', 'net_incomes', 'payment_incomes'];    

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
