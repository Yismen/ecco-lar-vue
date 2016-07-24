<?php namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Position extends Model {

	 protected $fillable = ['name', 'department_id', 'payment_id', 'salary'];

	/**
	 * ----------------------------------------------------
	 * Relationships
	 */
	
	public function departments()
	{
		return $this->belongsTo('App\Department', 'department_id');
	}

	public function payments()
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
		$this->attributes['name'] = ucwords(trim($name));
	}
}
