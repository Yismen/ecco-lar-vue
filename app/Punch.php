<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Punch extends Model {	

	protected $fillable = ['employee_id', 'punch'];

	/**
	 * -----------------------------------------------------------
	 * Relationships
	 */
	public function employee()
	{
		return $this->belongsTo('App\Employee');
	}
	
/**
 * ---------------------------------------------------
 * Accessors
 */

	public function getEmployeesListAttribute()
	{
		$employees = \App\Employee::all();

		return $employees->lists('fullName', 'id');
	}

	public function getEmployeesWithoutPunchListAttribute()
	{
		$employees = \App\Employee::doesntHave('punch')
			->orderBy('first_name')
			->actives()
			->get();

		return $employees->lists('fullName', 'id');
	}

}
