<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use App\Http\Requests\Request;
use App\Menu;
use App\Role;
use App\Permission;
use App\Http\Traits\MenusTrait;

class MenusController extends Controller
{
    use MenusTrait;

    protected $permission;

    public function __construct()
    {
        $this->middleware('authorize:view_menus|edit_menus|create_menus', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_menus', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_menus', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_menus', ['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Menu $menus)
    {
        $menus = $menus->orderBy('display_name', 'ASC')->get();

        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Role $roles)
    {
        $rolesList = $roles->pluck('display_name', 'id');

        return view('menus.create', compact('rolesList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Menu $menu, Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required|unique:menus,name',
            'display_name' => 'required|unique:menus,display_name',
            'roles_list' => 'required'
        ]);

        $this->createMenu($menu, $request, $permission);
        
        return redirect()->route('admin.menus.index')
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
        $rolesList = $roles->orderBy('display_name')->pluck('display_name', 'id');

        return view('menus.edit', compact('menu', 'rolesList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Menu $menu, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:menus,name,' . $menu->id . ',id',
            'display_name' => 'required|unique:menus,display_name,' . $menu->id . ',id',
            'roles_list' => 'required'
        ]);

        $this->updateMenu($menu, $request);

        return redirect()->route('admin.menus.show', $menu->name)
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

        return redirect()->route('admin.menus.index')
            ->withWarning("Menu collection [$menu->display_name] has been removed!");
    }
}
