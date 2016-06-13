<?php 

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = ['name', 'display_name', 'description'];
	/**
	 * Each role belongs to many menus
	 * 
	 * @return [type] [description]
	 */
	/**
	 * ==========================================
	 * Relationships
	 */
	public function menus()
	{
		return $this->belongsToMany('App\Menu')->orderBy('name', 'ASC');
	}

	public function users()
	{
		return $this->belongsTo(\App\User::class);
	}

	public function perms()
	{
		return $this->belongsTo(\App\Permission::class);
	}
	
	/**
	 * ========================================
	 * Methods
	 */
	
	/**
	 * ==========================================
	 * Scopes
	 */
	
	/**
	 * ======================================
	 * Accessors
	 */
	public function getUsersListsAttribute()
	{
		return $this->users ? $this->users->lists('id') : \App\User::lists('id');
	}

	public function getPermissionsListsAttribute()
	{
		// return $this->perms->lists('id');
		return $this->perms ? $this->perms->lists('id') : \App\Permission::lists('id');
	}

	public function getMenusListsAttribute()
	{
		return $this->menus->lists('id');
	}

	/**
	 * =======================================
	 * Mutators
	 */	

	public function setDisplayNameAttribute( $display_name )
	{
		$this->attributes['display_name'] = ucwords(str_replace(['.','_','-','/'], ' ', $display_name));
	}

	
}