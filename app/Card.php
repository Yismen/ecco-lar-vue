<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model {

	protected $fillable = ['employee_id', 'card'];

/**
 * -----------------------------------------------------------
 * Relationships
 */
	public function employee()
	{
		return $this->belongsTo('App\Employee')->orderBy('first_name', 'ASC');
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
/**
 * get employees with no cards added
 * @return [type] [description]
 */
	public function getEmployeesNullsListAttribute()
	{
		$employees = \App\Employee::get();

		return $employees->lists('fullName', 'id');
	}
}
