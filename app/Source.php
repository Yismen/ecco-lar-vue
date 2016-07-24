<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model {

	public function productions()
	{
	    return $this->hasMany('App\Production');
	}

}
