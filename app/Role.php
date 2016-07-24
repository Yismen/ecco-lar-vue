<?php 

namespace App;

use App\Menu;
use App\User;
use App\Permission;
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
		return $this->belongsToMany(Menu::class);
	}

	public function users()
	{
		return $this->belongsToMany(User::class);
	}

	public function perms()
	{
	    return $this->belongsToMany(Permission::class);
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
	public function getUsersListAttribute()
	{
		return User::orderBy('name')->lists('name', 'id');
	}

	public function getPermissionsListAttribute()
	{
		// return $this->perms->lists('id');
		return Permission::orderBy('display_name')->lists('display_name', 'id');
	}

	public function getMenusListAttribute()
	{
		return Menu::orderBy('display_name')->lists('display_name', 'id');
		
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