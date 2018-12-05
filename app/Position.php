<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name', 'department_id', 'payment_type_id', 'payment_frequency_id', 'salary'];

    protected $appends = ['name_and_department', 'pay_per_hours', 'departments_list', 'payment_types_list', 'payment_frequencies_list'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function payment_frequency()
    {
        return $this->belongsTo(PaymentFrequency::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * -----------------------------------------------------
     * Accessors
     */
    public function getNameAndDepartmentAttribute()
    {
        return ucwords(trim(
            ($this->department->department ?? '') . '-' . $this->name
        ));
    }

    public function getDepartmentsListAttribute()
    {
        return Department::select('id', 'department')->orderBy('department')->get();
    }

    public function getPaymentTypesListAttribute()
    {
        return PaymentType::select('id', 'name')->orderBy('name')->get();
    }

    public function getPayPerHoursAttribute()
    {
        $salary = $this->salary;

        if ($this->payment_type) {
            if (strtolower($this->payment_type->name) == 'salary') {
                return $salary / 23.83 / 8;
            }
        }

        return $salary;
    }

    public function getPaymentFrequenciesListAttribute()
    {
        return PaymentFrequency::select('id', 'name')->orderBy('name')->get();
    }

    /**
     * ----------------------------------------------------------
     * Mutators
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(strtolower(trim($name)));
    }
}
