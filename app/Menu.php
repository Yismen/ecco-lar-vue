<?php namespace App;

use App\Role;
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
		return $this->belongsToMany(Role::class);
	}


	public function getRolesListsAttribute()
	{
		return Role::orderBy('display_name')->lists('id');
	}

}
