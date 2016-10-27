<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use App\Http\Requests\Request;
use App\Permission;
use App\Role;

class PermissionsController extends Controller {
	private $rolesArray;


	public function __construct(Role $roles)
	{
		$this->middleware('authorize:view_permissions|edit_permissions|create_permissions', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_permissions', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_permissions', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_permissions', ['only'=>['destroy']]);
		
		$this->rolesArray = $roles->orderBy('display_name')->lists('display_name', 'id');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Permission $permissions)
	{
		$permissions = $permissions->orderBy('display_name')->get();

		return view('permissions.index', compact('permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Permission $permission)
	{
		$roles = $this->rolesArray;
		return view('permissions.create', compact('permission', 'roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Permission $permission, Request $requests)
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
	public function edit(Permission $permission)
	{
		$roles = $this->rolesArray;
		return view('permissions.edit', compact('permission', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Permission $permission, Request $requests)
	{
		$this->updatePermission($permission, $requests);

		return redirect()->route('admin.permissions.show', $permission->permission)
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

		return redirect()->route('admin.permissions.index')
			->withWarning("Permission [$permission->display_name] has been removed!");
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $permission     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	private function createPermission($permission, $requests)
	{
		$permission = $permission->create($requests->all());

		return $this->syncRoles($permission, $requests->get('roles_list'));
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $permission     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	private function updatePermission($permission, $requests)
	{
		$permission->update($requests->all());

		return $this->syncRoles($permission, $requests->get('roles_list'));
	}

	/**
	 * sync the roles model with the array selected by the user
	 * 
	 * @param  Menu   $permission  [description]
	 * @param  Array  $roles [description]
	 * @return [type]        [description]
	 */
	private function syncRoles(Permission $permission, Array $roles = null)
	{
		return $permission->roles()->sync((array) $roles);	
	}


}
