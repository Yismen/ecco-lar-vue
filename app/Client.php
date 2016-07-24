<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

	protected $fillable = ['name', 'goal'];

/**
 * ----------------------------------------------------------------------
 * Relatioships
 */
public function productions()
{
    return $this->hasMany('App\Production');
}

/**
 * ---------------------------------------------------------------------
 * scopes
 */

/**
 * ------------------------------------------------------------------
 * Accessors
 */


/**
 * ------------------------------------------------------------------
 * Mutators
 */

	public function setNameAttribute($name)
	{
		$this->attributes['name'] = strtoupper(trim($name));
	}
	
}
