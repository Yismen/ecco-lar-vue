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
    public function __construct(User $user, Menu $menu, Permission $permission)
    {
        $this->middleware('authorize:view-roles|edit-roles|create-roles', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-roles', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-roles', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-roles', ['only' => ['destroy']]);
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
        return view('roles.create', compact('role'));
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
            'users' => 'required',
        ]);

        $role = $role->createRole($request);

        \Cache::flush();

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
        return view('roles.edit', compact('role'));
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
            'users' => 'required',
        ]);

        $role->updateRole($request);

        \Cache::flush();

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

        \Cache::flush();

        return redirect()->route('admin.roles.index')
            ->withWarning("Role $role->name has been removed!!!");
    }
}
