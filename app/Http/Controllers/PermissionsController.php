<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Traits\PermissionsTrait;

use Illuminate\Http\Request;
// use App\Http\Requests\Request;
use App\Permission;
use App\Role;

class PermissionsController extends Controller 
{
    use PermissionsTrait;
    private $rolesArray;

    private $permission;


    public function __construct(Role $roles)
    {
        $this->middleware('authorize:view_permissions', ['only'=>['index','show']]);
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
    public function store(Permission $permission, Request $request)
    {
        $this->validateRequest($request, $permission)
            ->createPermission($permission, $request);

        return redirect()->route('admin.permissions.index')
            ->withSuccess("Permission ".$this->permission->display_name." has been created.");
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
    public function update(Permission $permission, Request $request)
    {
        $this->validateRequest($request, $permission)
            ->updatePermission($permission, $request);

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


}
