<?php namespace App;

use App\Employee;
use App\PaymentType;
use App\PaymentFrequency;
use Illuminate\Database\Eloquent\Model;

class Position extends Model {

	 protected $fillable = ['name', 'department_id', 'payment_type_id', 'payment_frequency_id', 'salary'];

	 protected $appends = ['name_and_department', 'pay_per_hours'];
	 	
	public function department()
	{
		return $this->belongsTo('App\Department');
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
		$department = $this->department ? $this->department->department : '';
		return ucwords(trim(
			$department.'-'.$this->attributes['name']
		));
	}

	public function getDepartmenstListAttribute()
	{
		return \App\Department::pluck('department', 'id');
	}

	public function getPaymentTypesListAttribute()
	{
		return PaymentType::pluck('name', 'id');
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
		return PaymentFrequency::pluck('name', 'id');
	}

	/**
	 * ----------------------------------------------------------
	 * Mutators
	 */

	public function setNameAttribute($name)
	{
		// $this->attributes['name'] = $this->department->department;
		$this->attributes['name'] = ucwords(trim($name));
	}
}
