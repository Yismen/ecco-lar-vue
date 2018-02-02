<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Login extends Model {

	protected $fillable = ['login', 'employee_id', 'system_id'];



	/**
	 * -------------------------------------------------------
	 * Relatioships
	 */

	public function employee()
	{
		return $this->belongsTo('App\Employee');
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
		$employees = Employee::orderBy('first_name')->actives()->get();

		return $employees->pluck('fullName', 'id');
	}

	public function getSystemsListAttribute()
	{
		return \App\System::pluck('name', 'id');
	}

	/**
	 * ----------------------------------------
	 * Mutators
	 */
	
	public function setLoginAttribute($login)
	{
		$this->attributes['login'] = trim($login);
	}
}
