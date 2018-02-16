<?php
namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\AppSetting;
use Illuminate\Http\Request;
use App\Http\Traits\UsersTrait;
use App\Events\EditUserSettings;
use App\Events\CreateUserSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller 
{
	use UsersTrait;
	private $request;
	protected $user;
	private $rolesList;

	private $random_password;


	public function __construct(Request $request, Role $role)
	{
		$this->middleware('authorize:view_users|edit_users|create_users', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_users', ['only'=>['edit','update', 'force_reset', 'force_change']]);
		$this->middleware('authorize:create_users', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_users', ['only'=>['destroy']]);
		
		$this->request = $request;
		$this->rolesList = $role->all();
		$this->random_password = str_random(15);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(User $users)
	{
		// return \Session::all();
		$users = $users
			->with(['roles'=> function($query){
				$query->orderBy('display_name');
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
		$rolesList = $this->rolesList;

		if ($this->request->ajax()) {
			return $user;
		}
		
		return view('users.create', compact('user', 'rolesList'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(User $user, Request $request)
	{
		$this->validateRequest($request, $user)
			->createUser($user);

		return redirect()->route('admin.users.index')
			->withImportant(true)
			->withSuccess(
				"The user {$user->email} has ben created! The password is {$this->random_password}. Please provide it to the user!"
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
		$rolesList = $this->rolesList;

		return view('users.edit', compact('user', 'rolesList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(User $user, Request $request)
	{
		$this->validateRequest($request, $user)
			->updateUser($user);

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
				->withDanger("It is not allowed to remove your own user.");
		}

		if ($user->is_admin) {
			return redirect()->route('admin.users.edit', $user->id)
				->withDanger("Super users can not be removed.");
		}

		$user->delete();

		return redirect()->route('admin.users.index')
			->withWarning("User $user->name has been removed!!!");

	}

	public function reset()
	{
		return view('users.reset');
	}

	public function change(User $user, Request $request)
	{
		$this->validate($request, [
			'old_password' => 'required',
			'new_password' => 'required|confirmed',
			'new_password_confirmation' => 'same:new_password',
		]);
		
		$user = User::whereEmail(
			auth()->user()->email
			)
			->first();

		if (Hash::check($request->old_password, $user->password)) {
			$user->password = Hash::make($request->new_password);
			$user->save();
			
			return redirect('admin')
				->withSuccess('Your password has been changed');
		}

		return redirect('/admin/users/reset')->withErrors(['old_password' => 'Wrong old password.']);
	}

	public function force_reset(User $user)
	{
		return view('users.force_reset', compact('user'));
	}

	public function force_change(User $user, Request $request)
	{
		if ($user->id === auth()->user()->id) {
			return redirect()->back()->withErrors(['error'=>'You are not allowed to change your own password here!']);
		}

		$this->updatePassword($user);

		return redirect("/admin/users/force_reset/{$user->id}")
			->with('important')
			->withNewPassword($this->random_password)
			->withWarning("Password {$this->random_password} is the new password for this user. Please advise to update inmediately!");
	}

	public function updateSettings(User $user, Request $request)
	{		
		$this->validate($request, [
			'skin' => '', // exits in skins table
			'layout'       => '', // exists in layouts table
			'mini'         => 'boolean', 
			'collapse'     => 'boolean',
		]);
		
		return $request->all();

		$user->settings = [
			'skin' => $request->skin,
			'layout' => $request->layout,
			'mini' => $request->mini,
			'collapse' => $request->collapse,
		];
		$this->updateOrCreateSettings($user);

        return redirect()->back();
	}

	private function updateOrCreateSettings($user)
	{
		$user->app_setting()->count() > 0 ? 
			event(new EditUserSettings($user)) : 
			event(new CreateUserSettings($user));

		Cache::forget('user-navbar');
	}
}