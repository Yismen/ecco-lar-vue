<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Downtime extends Model {

	protected $fillable = [
		'employee_id', 
		'insert_date', 
		'from_time', 
		'to_time', 
		'break_time', 
		'reason_id'
	];

/**
 * ==================================================================
 * Relationships
 */

	public function employee()
	{
		return $this->belongsTo('App\Employee', 'employee_id');
	}

	public function reason()
	{
		return $this->belongsTo('App\Reason', 'reason_id');
	}

/**
 * ================================================================
 * Scopes
 * Allows to query the database
 */
public function scopeSearchScope($query, $value)
{
	dd(date('Y-m-d', strtotime($value)));
	$query->whereInsertDate(date('Y-m-d', strtotime($value)));
}

public function scopeThisWeek($query)
{
	$query;
}


/**
 * ====================================================================
 * Accessors
 * Format the data when getting from the model
 */
	public function getEmployeesListAttribute()
	{
		return\App\Employee::all()
			->lists('fullName', 'id');
	}

	public function getReasonsListAttribute()
	{
		return\App\Reason::all()
			->lists('reason', 'id');
	}

	public function getInsertDateAttribute($date)
	{
		return Carbon::parse($date)->format('Y-m-d');
	}

	public function getFromTimeAttribute($time)
	{
		return Carbon::parse($time)->format('H:i:s');
	}

	public function getToTimeAttribute($time)
	{
		return Carbon::parse($time)->format('H:i:s');
	}
/**
 * ===============================================================
 * Mutators
 * Format the data before it is inserted to the database
 */

	public function setInsertDateAttribute($date)
	{
		$this->attributes['insert_date'] = Carbon::parse($date);
	}

	public function setFromTimeAttribute($time)
	{
		$this->attributes['from_time'] = Carbon::parse($time)->format('H:i:s');
	}

	public function setToTimeAttribute($time)
	{
		$this->attributes['to_time'] = Carbon::parse($time)->format('H:i:s');
	}

}
