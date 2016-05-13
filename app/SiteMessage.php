<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteMessage extends Model {

	protected $fillable = ['customer_name','phone','email','contact_types_id','message', 'answer'];

	public function contacttypes()
	{
		return $this->belongsTo('App\ContactType', 'contact_types_id');
	}

}
