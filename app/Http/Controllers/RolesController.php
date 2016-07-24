<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;


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
		$roles = $roles
				// ->with(['perms' => function($query){
				// 	$query->orderBy('permissions.display_name');
				// }])
				// ->with(['users'=>function($query){
				// 	$query->orderBy('users.name');
				// }])
				// ->with(['menus'=>function($query){
				// 	$query->orderBy('menus.display_name');
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

		return view('roles.create', compact('role'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Role $role, Request $requests)
	{
		$this->createRole($role, $requests);

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
	public function edit(Role $role)
	{
		return view('roles.edit', compact('role'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Role $role, Request $requests)
	{

		$this->updateRole($role, $requests);

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
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	protected function createRole($role, $requests)
	{
		$role = $role->create($requests->all());

		return $this->syncRelations($role,  $requests);
	}


	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $menu     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	protected function updateRole($role, $requests)
	{
		$role->update($requests->all());

		return $this->syncRelations($role,  $requests);
	}
	/**
	 * sync the roles model with the array selected by the user
	 * 
	 * @param  Menu   $menu  [description]
	 * @param  Array  $roles [description]
	 * @return [type]        [description]
	 */
	protected function syncRelations(Role $role, $requests)
	{
		// dd($requests->all());
		$role->users()->sync((array) $requests->input('users'));	
		$role->perms()->sync((array) $requests->input('perms'));	
		$role->menus()->sync((array) $requests->input('menus'));	

		return $role;

	}

}
