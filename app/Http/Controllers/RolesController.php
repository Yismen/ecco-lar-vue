<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Http\Request;
use Cache;

class RolesController extends Controller
{
    private $usersList;
    private $menusList;
    private $permissionsList;

    public function __construct(User $user, Menu $menu, Permission $permission)
    {
        $this->middleware('authorize:view-roles|edit-roles|create-roles', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-roles', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-roles', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-roles', ['only' => ['destroy']]);

        $this->usersList = $user->orderBy('name')->pluck('name', 'id');
        $this->menusList = $menu->orderBy('name')->pluck('name', 'id');
        $this->permissionsList = $permission->orderBy('name')->pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Role $roles)
    {
        $roles = $roles->orderBy('name')->paginate(10);

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
            'name' => 'required|unique:roles,name',
            'users_list' => 'required',
        ]);

        $role = $role->createRole($request);

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
            'name' => 'required',
            'users_list' => 'required',
        ]);

        $role->updateRole($request);

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

        Cache::forget('menus');
        Cache::forget('roles');

        return redirect()->route('admin.roles.index')
            ->withWarning("Role $role->name has been removed!!!");
    }
}
