<?php 

namespace App;

use Carbon\Carbon;
use App\Reason;
use Illuminate\Database\Eloquent\Model;

class Production extends Model 
{

	protected $fillable = ['insert_date', 'year', 'month', 'week', 'employee_id', 'name', 'production_hours', 'downtime', 'production', 'client_id', 'source_id', 'reason_id', 'unique_id'];

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
