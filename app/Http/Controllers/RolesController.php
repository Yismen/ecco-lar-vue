<?php 

namespace App\Http\Controllers;

use App\Menu;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RolesController extends Controller {
	private $usersList;
	private $menusList;
	private $permissionsList;


	public function __construct(User $user, Menu $menu, Permission $permission)
	{
		$this->middleware('authorize:view_roles|edit_roles|create_roles', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_roles', ['only'=>['edit','update']]);	
		$this->middleware('authorize:create_roles', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_roles', ['only'=>['destroy']]);
		
		$this->usersList = $user->orderBy('name')->lists('name', 'id');
		$this->menusList = $menu->orderBy('display_name')->lists('display_name', 'id');
		$this->permissionsList = $permission->orderBy('display_name')->lists('display_name', 'id');
	}
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Role $roles)
	{
		$roles = $roles
			->orderBy('display_name')
			// ->with(['perms' => function($query){
			// 	$query->orderBy('permissions.display_name');
			// }])
			// ->with(['users'=>function($query){
			// 	$query->orderBy('users.name');
			// }])
			// ->with(['menus'=>function($query){
			// 	$query->orderBy('roles.display_name');
			// }])
			->paginate(10);

		return view('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Role $role)
	{
		$usersList = $this->usersList;
		$permissionsList = $this->permissionsList;
		$menusList = $this->menusList;
		
		return view('roles.create', compact('role', 'usersList', 'permissionsList', 'menusList'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Role $role, Request $request)
	{
		$this->validate($request, [
		    // 'name' => 'required',
		    'display_name' => 'required',
		    'users_list' => 'required',
		]);

		$this->createRole($role, $request);

		return redirect()->route('admin.roles.index')
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
	public function edit(Role $role)
	{
		$usersList = $this->usersList;
		$permissionsList = $this->permissionsList;
		$menusList = $this->menusList;
		
		return view('roles.edit', compact('role', 'usersList', 'permissionsList', 'menusList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Role $role, Request $request)
	{		
		$this->validate($request, [
		    // 'name' => 'required',
		    'display_name' => 'required',
		    'users_list' => 'required',
		]);

		$this->updateRole($role, $request);

		return redirect()->route('admin.roles.show', $role->name)
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

		return redirect()->route('admin.roles.index')
			->withWarning("Role $role->name has been removed!!!");
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $menu     [description]
	 * @param  [object] $request [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	protected function createRole($role, $request)
	{
		$role = $role->create($request->all());

		return $this->syncRelations($role,  $request);
	}


	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $menu     [description]
	 * @param  [object] $request [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	protected function updateRole($role, $request)
	{
		$role->update($request->all());

		return $this->syncRelations($role,  $request);
	}
	/**
	 * sync the roles model with the array selected by the user
	 * 
	 * @param  Menu   $menu  [description]
	 * @param  Array  $roles [description]
	 * @return [type]        [description]
	 */
	protected function syncRelations(Role $role, $request)
	{
		$role->users()->sync((array) $request->input('users_list'));	
		$role->perms()->sync((array) $request->input('permissions_list'));	
		$role->menus()->sync((array) $request->input('menus_list'));	

		return $role;

	}

}
