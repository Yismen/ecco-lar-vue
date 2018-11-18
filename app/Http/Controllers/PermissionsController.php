<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionsController extends Controller
{
    private $permission;

    public function __construct()
    {
        $this->middleware('authorize:view_permissions', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_permissions', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_permissions', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_permissions', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Permission $permissions)
    {
        $permissions = $permissions->orderBy('resource')->get();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Permission $permission)
    {
        return view('permissions.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Permission $permission, Request $request)
    {
        $this->validate($request, [
            'resource' => 'required|min:3|unique:permissions,resource',
            'actions' => 'required|array',
            'roles' => 'array|exists:roles,id',
        ]);

        $permission->createPermission($request);

        return redirect()->route('admin.permissions.index')
            ->withSuccess('Permissions created.');
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
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Permission $permission, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:permissions,resource,'.$permission->id,
            'roles' => 'array|exists:roles,id',
        ]);

        $permission = $permission->updatePermission($request);

        return redirect()->route('admin.permissions.show', $permission->name)
            ->withSuccess("Menu $permission->name has been updated.");
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
            ->withWarning("Permission [$permission->name] has been removed!");
    }
}
