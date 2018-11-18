<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Events\EditUserSettings;
use App\Events\CreateUserSettings;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    private $request;
    protected $user;

    public function __construct(Request $request, Role $role)
    {
        $this->middleware('authorize:view_users|edit_users|create_users', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_users', ['only' => ['edit', 'update', 'force_reset', 'force_change']]);
        $this->middleware('authorize:create_users', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_users', ['only' => ['destroy']]);

        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(User $users)
    {
        $users = $users
            ->with(['roles' => function ($query) {
                $query->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(User $user)
    {
        if ($this->request->ajax()) {
            return $user->append('role-list');
        }

        return view('users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
        ]);


        $password = $user->createUser($request);

        return redirect()->route('admin.users.index')
            ->withImportant(true)
            ->withSuccess(
                "The user {$user->email} has ben created! The password is {$password}. Please provide it to the user!"
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|unique:users,username,' . $user->id,
        ]);
        $user->updateUser($request);

        return redirect()->route('admin.users.index')
            ->withSuccess("User {$user->name} has been updated. Current status is Active = {$user->is_active}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->user()->id) {
            return redirect()->route('admin.users.edit', $user->id)
                ->withDanger('It is not allowed to remove your own user.');
        }

        if ($user->is_admin) {
            return redirect()->route('admin.users.edit', $user->id)
                ->withDanger('Super users can not be removed.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->withWarning("User $user->name has been removed!!!");
    }
}
