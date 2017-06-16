<?php
namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;

class UsersController extends Controller {
	private $request;
	private $rolesList;


	public function __construct(Request $request, Role $role)
	{
		$this->middleware('authorize:view_users|edit_users|create_users', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_users', ['only'=>['edit','update', 'force_reset', 'force_change']]);
		$this->middleware('authorize:create_users', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_users', ['only'=>['destroy']]);
		
		$this->request = $request;
		$this->rolesList = $role->all();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(User $users)
	{
		$users = $users
			->with(['roles'=> function($query){
				$query->orderBy('display_name');
			}])
			->orderBy('name')
			->paginate(25);

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
		$rand = str_random(15);
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'username' => 'required|unique:users,username',
			'password' => $rand
		]);

		$user = $this->createUser($user, $rand);

		$notify = $this->request->notify;
		Mail::later(5, 'emails.welcome', ['user'=>$user, 'password' => $rand], function($m) use ($user, $notify){
        	$m->to('yismen.jorge@ecco.com.do', 'Yismen Jorge')->subject('Welcome to Dainsys');
			if ($notify && config('env') == 'production') {
			// $m->from('hello@app.com', 'Your Application');
				$m->cc($user->email, $user->name);
			}
		});

		return redirect()->route('admin.users.index')
			->withImportant(true)
			->withSuccess("The user $user->email has ben created! The password is $rand. Please provide it to the user!");
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
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,' . $user->id,
			'username' => 'required|unique:users,username,' . $user->id,
		]);

		$this->updateUser($user, $request);

		return redirect()->route('admin.users.show', $user->id)
			->withSuccess("User $user->name has been updated.");
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
		// $user = User::findOrFail($user);
		return view('users.force_reset', compact('user'));
	}

	public function force_change(User $user, Request $request)
	{
		$password = str_random(15);

		if ($user->id === auth()->user()->id) {
			return redirect()->back()->withErrors(['error'=>'You are not allowed to change your own password here!']);
		}

		$user->password = Hash::make($password);
		$user->save();

		$notify = $this->request->notify;
		Mail::later(5, 'emails.password-reset', compact('user', 'password'), function($m) use ($user, $notify){
        	$m->to('yismen.jorge@ecco.com.do', 'Yismen Jorge');
			if ($notify && config('env') == 'production') {
			// $m->from('hello@app.com', 'Your Application');
				$m->cc($user->email, $user->name);
			}

			$m->subject('Change of Password');
		});

		return redirect("/admin/users/force_reset/$user->id")
			->with('important')
			->withNewPassword($password)
			->withWarning("Password $password is the new password for this user. Please advise to update inmediately!");
	}
	private function createUser($user, $rand)
	{
		$user = $user->create([
			"name"      => $this->request->name,
			"email"     => $this->request->email,
			"username"  => $this->request->username,
			"password"  => Hash::make($rand),
			"is_active" => $this->request->is_active,
			"is_admin"  => $this->request->is_admin
		]);

		return $this->syncRoles($user, $this->request->input('roles'));
	}

	private function updateUser($user)
	{
		$user->update($this->request->all());

		return $this->syncRoles($user, $this->request->input('roles'));
	}

	/**
	 * sync the roles model with the array selected by the user
	 * 
	 * @param  Menu   $menu  [description]
	 * @param  Array  $roles [description]
	 * @return [type]        [description]
	 */
	public function syncRoles(User $user, Array $roles = null)
	{
		$user->roles()->sync((array) $roles);

		return $user;	
	}



}
