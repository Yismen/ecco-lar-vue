<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = ['name', 'display_name', 'description'];
	/**
	 * Each role belongs to many menus
	 * 
	 * @return [type] [description]
	 */
	public function menus()
	{
		return $this->belongsToMany('App\Menu')->orderBy('name', 'ASC');
	}

	public function setDisplayNameAttribute( $display_name )
	{
		$this->attributes['display_name'] = ucwords(str_replace(['.','_','-','/'], ' ', $display_name));
	}

	public function getUsersListsAttribute()
	{
		return $this->users->lists('id');
	}

	public function getPermissionsListsAttribute()
	{
		return $this->perms->lists('id');
	}

	public function getMenusListsAttribute()
	{
		return $this->menus->lists('id');
	}
}