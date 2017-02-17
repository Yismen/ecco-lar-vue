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
	public function getEmployeesWhitoutCardsListAttribute()
	{
		$employees = \App\Employee::doesntHave('card')
			->orderBy('first_name')
			->actives()
			->get();

		return $employees->lists('fullName', 'id');
	}
	/**
	 * --------------------------------------------------
	 * Scopes
	 */
	public function scopeUnassigned($query)
	{
		return $query->has('employee', false);
	}
}
