<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use App\Http\Requests\MenusRequests;
use App\Menu;
use App\Role;
use App\Permission;

class MenusController extends Controller {

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
	public function index(Menu $menus)
	{
		$menus = $menus->get();

		return view('menus.index', compact('menus'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Role $roles)
	{
		$rolesList = $roles->lists('display_name', 'id');

		return view('menus.create', compact('rolesList'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Menu $menu, MenusRequests $requests, Permission $permission)
	{
		$this->createMenu($menu, $requests, $permission);

		return redirect()->route('menus.index')
			->withSuccess("Menu $menu->display_name has bee created.");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Menu $menu)
	{
		return view('menus.show', compact('menu'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Menu $menu, Role $roles)
	{
		$rolesList = $roles->lists('display_name', 'id');

		return view('menus.edit', compact('menu', 'rolesList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Menu $menu, MenusRequests $requests)
	{
		$this->updateMenu($menu, $requests);

		return redirect()->route('menus.show', $menu->name)
			->withSuccess("Menu $menu->display_name has been updated.");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Menu $menu, Permission $permission)
	{
		$menu->delete();

		$this->destroyPermissions($menu, $permission);

		return redirect()->route('menus.index')
			->withWarning("Menu collection [$menu->display_name] has been removed!");
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $menu     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	public function createMenu($menu, $requests, $permission)
	{
		$menu = $menu->create($requests->all());		

		$this->createPermissions($menu, $permission);

		return $this->syncRoles($menu, $requests->get('roles_lists'));
	}

	/**
	 * handle the process of creating the menu item
	 * 
	 * @param  [object] $menu     [description]
	 * @param  [object] $requests [description]
	 * @return [process]           [the action of syncing the menu-roles]
	 */
	public function updateMenu($menu, $requests)
	{
		$menu->update($requests->all());

		return $this->syncRoles($menu, $requests->get('roles_lists'));
	}

	/**
	 * sync the roles model with the array selected by the user
	 * 
	 * @param  Menu   $menu  [description]
	 * @param  Array  $roles [description]
	 * @return [type]        [description]
	 */
	public function syncRoles(Menu $menu, Array $roles = null)
	{
		return $menu->roles()->sync((array) $roles);	
	}

	public function createPermissions($menu, Permission $permission)
	{
		/**
		 * Editor Role
		 */
		$editor = new $permission;

		$editor->name = $menu->name . '_editor';
		$editor->display_name = ucwords($menu->name) . ' Editor';
		$editor->description = 'Can edit, create and destroy ' . ucwords($menu->name). '\'s items';

		$editor->save();
		/**
		 * Editor Role
		 */
		
		$viewer = new $permission;

		$viewer->name = $menu->name . '_viewer';
		$viewer->display_name = ucwords($menu->name) . ' Viewer';
		$viewer->description = 'Can view ' . ucwords($menu->name) . '\'s items';

		$viewer->save();
	}

	public function destroyPermissions($menu, Permission $permission)
	{
		/**
		 * Editor Role
		 */
		$editor = $permission->whereName($menu->name . '_editor')->first();

		if ($editor) {
			$editor->delete();
		}

		/**
		 * Editor Role
		 */
		
		$viewer = $permission->whereName($menu->name . '_viewer')->first();

		if ($viewer) {
			$viewer->delete();
		}

	}


}
