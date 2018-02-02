<?php

namespace App;

use App\Employee;
use Carbon\Carbon;
use App\PayrollDiscountConcept;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PayrollAdditional extends Model
{
    protected $fillable = ['date', 'employee_id', 'name', 'additional_amount', 'concept_id', 'comment'];

    protected $dates = ['date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function concept()
    {
        return $this->belongsTo(PayrollAdditionalConcept::class);
    }

    public function getConceptsListAttribute()
    {
        return PayrollAdditionalConcept::pluck('name', 'id');
    }

    public function getEmployeesListAttribute()
    {
        return Employee::select(
            DB::raw("trim(concat(first_name, ' ',second_first_name, ' ', last_name, ' ', second_last_name)) as name, id")
        )->orderBy('first_name', 'ASC')->actives()->pluck('name', 'id');
    }

    public function getDateAttribute($date)
    {
        $date = Carbon::parse($date);
        return $date->format("Y-m-d");
    }
}
