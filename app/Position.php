<?php namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Position extends Model {

	 protected $fillable = ['name', 'department_id', 'payment_id', 'salary'];

	 protected $appends = ['name_and_department'];
	 /**
	 * ----------------------------------------------------
	 * Relationships
	 */
	
	public function department()
	{
		return $this->belongsTo('App\Department');
	}

	public function payment()
	{
		return $this->belongsTo('App\Payment', 'payment_id');
	}

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}

	/**
	 * -----------------------------------------------------
	 * Accessors
	 */
	// public function getSalaryAttribute($salary)
	// {
	// 	return number_format($salary, 2);
	// }

	public function getNameAndDepartmentAttribute($name)
	{
		$department = $this->department ? $this->department->department : '';
		return ucwords(trim(
			$department.'-'.$this->attributes['name']
		));
	}

	public function getDepartmenstListAttribute()
	{
		return \App\Department::lists('department', 'id');
	}

	public function getPaymentsListAttribute()
	{
		return \App\Payment::lists('payment_type', 'id');
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
