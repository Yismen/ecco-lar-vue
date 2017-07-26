<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollTemp extends Model
{
    protected $fillable  = [
        'from_date',
        'to_date',
        'payroll_id',
        'employee_id',
        'name',
        'name_slug',
        'regular_income',
        'nightly_income',
        'holidays_income',
        'overtime_income',
        'training_income',
        'tss_payroll_income',
        'incentive_incomes',
        'payment_incomes',
        'other_incomes',
        'ars_discount',
        'afp_discount',
        'other_discounts',
    ];

}
