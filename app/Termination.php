<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Termination extends Model {

	protected $fillable = ['employee_id', 'termination_date', 'termination_type_id', 'termination_reason_id', 'can_be_rehired', 'comments'];	

	protected $dates = ['termination_date'];

/**
 * ----------------------------------------------------------------------------------
 * Relationships
 */
	public function employee()
	{
		return $this->belongsTo('App\Employee');
	}

	public function terminationType()
	{
		return $this->belongsTo('App\TerminationType');
	}

	public function terminationReason()
	{
		return $this->belongsTo('App\TerminationReason');
	}

	/**
	 * ======================================================================================
	 * Accessors
	 */
	
	// public function getTerminationDateAttribute($date)
	// {
	// 	return Carbon::parse($this->attributes['termination_date'])->format('Y-m-d');
	// }

	public function terminateEmployee($employee, $request)
	{
		
	}

}
