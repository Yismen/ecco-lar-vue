<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Production extends Model {

	protected $fillable = ['insert_date', 'employee_id', 'name', 'production_hours', 'production', 'client', 'source'];

	/**
	 * ==========================================================
	 * Relationships
	 */
	public function employee()
	{
		return $this->belongsTo('App\Employee');
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
	/**
	 * ==========================================================
	 * Mutators
	 */
	
	/**
	 * ===========================================================
	 * Methods
	 */
	
	public function exists()
	{
		
	}
}
