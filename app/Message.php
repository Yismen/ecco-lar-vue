<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	protected $fillable = ['username', 'username_to', 'message'];
	// 
	public function user()
	{
		return $this->belongsTo('App\User', 'username_from', 'username');
	}

}
