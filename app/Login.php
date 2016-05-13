<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model {

	protected $fillable = ['login', 'employee_id', 'system_id'];



	/**
	 * -------------------------------------------------------
	 * Relatioships
	 */

	public function employee()
	{
		return $this->belongsTo('App\Employee')->orderBy('first_name', 'ASC');
	}

	public function system()
	{
		return $this->belongsTo('App\System');
	}

	/**
	 * --------------------------------------------
	 * Accessors
	 */

	public function getEmployeesListAttribute()
	{
		$employees = \App\Employee::all();

		return $employees->lists('fullName', 'id');
	}

	public function getSystemsListAttribute()
	{
		// dd(\App\Employee::lists('first_name', 'id'));
		return \App\System::lists('name', 'id');
	}
}
