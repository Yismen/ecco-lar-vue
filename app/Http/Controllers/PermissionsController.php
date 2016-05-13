<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use App\Http\Requests\PermissionsRequests;
use App\Permission;
use App\Role;

class PermissionsController extends Controller {

	public function __construct()
	{
		// $this->middleware('auth');
		// $this->middleware('authorize');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Permission $permissions)
	{
		$permissions = $permissions->get();

		return view('permissions.index', compact('permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Role $roles)
	{
		$rolesList = $roles->lists('display_name', 'id');

		return view('permissions.create', compact('rolesList'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Permission $permission, PermissionsRequests $requests)
	{
		$this->createPermission($permission, $requests);

		return redirect()->route('permissions.index')->withSuccess("Permission $permission->display_name has been created.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Permission $permission)
	{
		return view('permissions.show', compact('permission'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Permission $permission, Role $roles)
	{
		$rolesList = $roles->lists('display_name', 'id');

		return view('permissions.edit', compact('permission', 'rolesList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Permission $permission, PermissionsRequests $requests)
	{
		$this->updatePermission($permission, $requests);

		return redirect()->route('permissions.show', $role->permission)
			->withSuccess("Menu $permission->display_name has been updated.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Permission $permission)
	{
		$permission->delete();

		return redirect()->route('permissions.index')
			->withWarning("Permission [$permission->display_name] has been removed!");
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $permission     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	public function createPermission($permission, $requests)
	{
		$permission = $permission->create($requests->all());

		return $this->syncRoles($permission, $requests->get('roles_lists'));
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $permission     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	public function updatePermission($permission, $requests)
	{
		$permission->update($requests->all());

		return $this->syncRoles($permission, $requests->get('roles_lists'));
	}

	/**
	 * sync the roles model with the array selected by the user
	 * 
	 * @param  Menu   $permission  [description]
	 * @param  Array  $roles [description]
	 * @return [type]        [description]
	 */
	public function syncRoles(Permission $permission, Array $roles = null)
	{
		return $permission->roles()->sync((array) $roles);	
	}


}
