<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Role;
use App\User;
use App\Permission;
use App\Menu;


class RolesController extends Controller {

	public function __construct()
	{
		// $this->middleware('authorize');
		
	}
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Role $roles)
	{
		$roles = $roles->paginate(10);

		return view('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(User $users, Permission $permissions, Menu $menus)
	{
		$usersLists = $users->lists('name', 'id');
		$permissionsLists = $permissions->lists('display_name', 'id');
		$menusLists = $menus->lists('display_name', 'id');

		return view('roles.create', compact('role', 'usersLists', 'permissionsLists', 'menusLists'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Role $role, Request $requests, User $users, Permission $permissions, Menu $menus)
	{
		$this->createRole($role, $requests, $users, $permissions, $menus);

		return redirect()->route('menus.index')
			->withSuccess("Role $role->display_name has bee created.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Role $role)
	{
		return view('roles.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Role $role, User $users, Permission $permissions, Menu $menus)
	{

		$usersLists = $users->lists('name', 'id');
		$permissionsLists = $permissions->lists('display_name', 'id');
		$menusLists = $menus->lists('display_name', 'id');

		return view('roles.edit', compact('role', 'usersLists', 'permissionsLists', 'menusLists'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Role $role, Request $requests, User $users, Permission $permissions, Menu $menus)
	{
		$this->updateRole($role, $requests, $users, $permissions, $menus);

		return redirect()->route('roles.show', $role->name)
			->withSuccess("Role $role->display_name has bee update.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Role $role)
	{
		$role->delete();

		return redirect()->route('roles.index')
			->withWarning("Role $role->name has been removed!!!");
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $menu     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	public function createRole($role, $requests, $users, $permissions, $menus)
	{
		$role = $role->create($requests->all());

		return $this->syncRelations($role,  $requests->get('users_lists'),  $requests->get('permissions_lists'),  $requests->get('menus_lists'));
	}


	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $menu     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	public function updateRole($role, $requests, $users, $permissions, $menus)
	{
		$role->update($requests->all());

		return $this->syncRelations($role,  $requests->get('users_lists'),  $requests->get('permissions_lists'),  $requests->get('menus_lists'));
	}
	/**
	 * sync the roles model with the array selected by the user
	 * 
	 * @param  Menu   $menu  [description]
	 * @param  Array  $roles [description]
	 * @return [type]        [description]
	 */
	public function syncRelations(Role $role, Array $users = null, Array $perms = null, Array $menus = null)
	{
		
		$role->users()->sync((array) $users);	
		$role->perms()->sync((array) $perms);	
		return $role->menus()->sync((array) $menus);	

	}

}
