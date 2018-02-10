<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	protected $fillable = ['sector', 'street_address', 'city'];

/**
 * -------------------------------------------------------------------
 * Relatioships
 */
	public function employees()
	{
		return $this->belongsTo('App\Employee', 'employee_id');
	}
	
	public function setSectorAttribute($sector)
	{
		return $this->attributes['sector'] = ucwords(trim($sector));
	}

	public function setStreetAddressAttribute($street_address)
	{
		return $this->attributes['street_address'] = ucwords(trim($street_address));
	}

	public function setCityAttribute($city)
	{
		return $this->attributes['city'] = ucwords(trim($city));
	}
}
