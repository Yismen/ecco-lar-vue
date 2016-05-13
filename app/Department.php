<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	protected $fillable = [
		'department'
	];

	/**
	 * Update the Department name field to be ucwords
	 * 
	 * @param  [string] $department the department name's field
	 * @return string             converted string
	 */
	public function getDepartmentAttribute($department)
	{
		return ucwords($department);
	}

	/**
	 * many to many relationship with the employee model
	 * @return [array] [employees associated to current Department]
	 */
	public function employees()
	{
		return $this->belongsToMany('App\Employee');
	}
	

}
