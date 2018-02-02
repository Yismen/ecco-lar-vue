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
	/**
	 * Get a list of the users associated with this role.
	 * 
	 * @return [type] [description]
	 */
	public function getUsersListAttribute()
	{
		return $this->users->pluck('id')->toArray();
	}

	/**
	 * Return a list of permissions associated with this role.
	 * 
	 * @return [type] [description]
	 */
	public function getPermissionsListAttribute()
	{
		return $this->perms->pluck('id')->toArray();
	}

	/**
	 * Return a list of menus associated with current role.
	 * 
	 * @return [type] [description]
	 */
	public function getMenusListAttribute()
	{
		return $this->menus->pluck('id')->toArray();
		
	}

	/**
	 * =======================================
	 * Mutators
	 */	
	public function setDisplayNameAttribute( $display_name )
	{
		$this->attributes['display_name'] = ucwords(str_replace(['.','_','-','/'], ' ', $display_name));
		$this->attributes['name'] = str_slug($display_name, $separator = "-");
	}

	
}