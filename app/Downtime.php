<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Downtime extends Model {

	protected $fillable = [
		'employee_id', 
		'name', 
		'insert_date', 
		'from_time', 
		'to_time', 
		'break_time', 
		'reason_id',
		'unique_id',
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

	// public function getFromTimeAttribute($time)
	// {
	// 	return Carbon::parse($time)->format('H:i:s');
	// }

	// public function getToTimeAttribute($time)
	// {
	// 	return Carbon::parse($time)->format('H:i:s');
	// }
/**
 * ===============================================================
 * Mutators
 * Format the data before it is inserted to the database
 */

	public function setInsertDateAttribute($date)
	{
		$this->attributes['insert_date'] = Carbon::parse($date);
	}

	public function setYearAttribute($date)
	{
		$this->attributes['year'] = Carbon::parse($this->attributes['insert_date'])->year;
	}
	
	public function setMonthAttribute($date)
	{
		$this->attributes['month'] = Carbon::parse($this->attributes['insert_date'])->month;
	}
	
	public function setWeekAttribute($date)
	{
		$this->attributes['week'] = Carbon::parse($this->attribute['insert_date'])->weekOfYear;
	}

	public function setTotalHoursAttribute($hours)
	{
		$from_time = Carbon::createFromTimestamp($this->attributes['from_time']);

		$diff_in_hours = $from_time->diffInHours(
			Carbon::createFromTimestamp($this->attributes['to_time']), false
			);

		$break_time = $this->attributes['break_time'] / 60; 

		return $this->attributes['tota_hours'] = $diff_in_hours - $break_time;
	}

	
	public function setUniqueIdAttribute($unique_id)
	{
		return $this->attributes['unique_id'] = $this->attributes['insert_date'].'-'.$this->attributes['employee_id'];
	}


	// public function setFromTimeAttribute($time)
	// {
	// 	$this->attributes['from_time'] = Carbon::parse($time)->format('H:i:s');
	// }

	// public function setToTimeAttribute($time)
	// {
	// 	$this->attributes['to_time'] = Carbon::parse($time)->format('H:i:s');
	// }

}
