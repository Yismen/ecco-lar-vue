<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {	

	protected $table = 'contacts';

	protected $fillable = ['username','name', 'main_phone', 'works_at', 'position', 'secondary_phone', 'email', 'public'];

	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo('App\User', 'username', 'username');
	}

	public function scopeCurrentuser( $query )
	{
		$query->whereUsername(\Auth::user()->username);
	}

}
