<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollSummary extends Model
{
    // protected $table = "payroll_summaries";

    protected $fillable = [
        'from_date',
        'to_date',
        'payment_date',
        'payroll_id',
        'unique_id',

        'employee_id',
        'name',

        'regular_incomes',
        'nightly_incomes',
        'holidays_incomes',
        'overtime_incomes',
        'training_incomes',

        'incentive_incomes',
        'other_incomes',

        'tss_payroll_incomes',
        'gross_incomes',
        'net_incomes',
        'payment_incomes',

        'ars_discounts',
        'afp_discounts',
        'other_discounts',
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
