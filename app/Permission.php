<?php namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

	protected $fillable = ['name','display_name', 'description'];

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

// use Illuminate\Database\Eloquent\Model;

// class Permission extends Model {

// 	//

// }
