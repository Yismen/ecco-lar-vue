<?php 

namespace App;

use App\Client;
use App\Reason;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Production extends Model 
{

	protected $fillable = [
					'insert_date',	
					'employee_id',
					'name',
					'in_time',
					'production_hours',
					'break_time',
					'downtime',
					'out_time',
					'production',
					'reason_id',
					'client_id',
					'source_id',
					 'unique_id'
					];

	 protected $casts = [
		'employee_id' => 'integer',
		'year'        => 'integer',
		'month'       => 'integer',
		'week'        => 'integer',
		'production'  => 'integer', 
    ];

	/**
	 * ==========================================================
	 * Relationships
	 */
	public function employee()
	{
		return $this->belongsTo('App\Employee');
	}

	public function source()
	{
	    return $this->belongsTo('App\Source');
	}

	public function client()
	{
	    return $this->belongsTo('App\Client');
	}

	public function reason()
	{
	    return $this->belongsTo(Reason::class);
	}

	/**
	 * =============================================================
	 * Scopes
	 */
	
	/**
	 * ============================================================
	 * Accessors
	 */
	public function getClientListAttribute()
	{
		return $this->client()->lists('id')->toArray();
		// return Client::lists('name', 'id');
	}

	public function getSourceListAttribute()
	{
		return $this->source()->lists('id')->toArray();
	}

	public function getReasonListAttribute()
	{
		return $this->reason()->lists('id');
	}

	public function getInsertDateAttribute( $date )
	{
		return Carbon::parse( $date )->format('Y-m-d');
	}

	public function getYearAttribute()
	{
		return Carbon::parse($this->attribute['insert_date'])->year;
	}

	public function getMonthAttribute()
	{
		return Carbon::parse($this->attribute['insert_date'])->month;
	}

	public function getWeekAttribute()
	{
		return Carbon::parse($this->attribute['insert_date'])->weekOfYear;
	}

	/**
	 * ==========================================================
	 * Mutators
	 */
	
	public function seNameAttribute($name)
	{
		$employee  = Employee::find($this->employee_id);
		if ($employee) {
			return $this->attributes['name'] = $employee->first_name . " " . $employee->last_name;
		}
		return $this->attributes['name'] = $name;
	}
	
	public function setInTimeAttribute($intime)
	{
		return $this->attributes['in_time'] = Carbon::parse($intime);
	}
	
	public function setOutTimeAttribute($date)
	{
		$in = Carbon::parse($this->attributes['in_time']);

		return $this->attributes['out_time'] = $in
			->addHours($this->attributes['production_hours'])
			->addHours($this->attributes['downtime'])
			->addMinutes($this->attributes['break_time']);
	}
	
	// public function setYearAttribute($date)
	// {
	// 	$this->attributes['year'] = Carbon::parse($this->attributes['insert_date'])->year;
	// }
	
	// public function setMonthAttribute($date)
	// {
	// 	$this->attributes['month'] = Carbon::parse($this->attributes['insert_date'])->month;
	// }
	
	// public function setWeekAttribute($date)
	// {
	// 	$this->attributes['week'] = Carbon::parse($this->attribute['insert_date'])->weekOfYear;
	// }
	
	public function setUniqueIdAttribute($unique_id)
	{
		return $this->attributes['unique_id'] = $this->attributes['insert_date'].'-'.$this->attributes['employee_id'].'-'.$this->attributes['client_id'].'-'.$this->attributes['source_id'];
	}
	
	/**
	 * ===========================================================
	 * Methods
	 */
	
	public function exists()
	{
		
	}

	public function removeIfExistis()
	{
		// delete any previous instance of this record
				static::whereInsertDate($row['insert_date'])
						->whereEmployeeId($row['employee_id'])
						->whereClient($row['client'])
						->whereSource($row['source'])
						->first()
						->delete(); 
	}
}
