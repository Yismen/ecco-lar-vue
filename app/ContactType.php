<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model {

	protected $fillable = ['contact_type','description'];

	public function sitemessages()
	{
		return $this->hasMany('App\SiteMessage', 'id');
	}

}
