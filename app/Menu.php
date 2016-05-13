<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	protected $fillable = ['name','display_name', 'description', 'icon'];

	protected $guarded = [];

	/**
	 * a module belongs to many roles
	 * 
	 * @return [type] [description]
	 */
	public function roles()
	{
		return $this->belongsToMany('App\Role');
	}


	public function getRolesListsAttribute()
	{
		return $this->roles->lists('id');
	}

}
