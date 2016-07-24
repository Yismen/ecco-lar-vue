<?php 

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Production extends Model 
{

	protected $fillable = ['insert_date', 'year', 'month', 'week', 'employee_id', 'name', 'production_hours', 'production', 'client_id', 'source_id'];

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

	/**
	 * =============================================================
	 * Scopes
	 */
	
	/**
	 * ============================================================
	 * Accessors
	 */
	public function getInsertDateAttribute( $date )
	{
		return Carbon::parse( $date )->format('m-d-Y');
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
