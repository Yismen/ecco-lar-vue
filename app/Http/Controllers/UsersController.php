<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller {
	private $request;


	public function __construct(Request $request)
	{
		// $this->middleware('authorize', ['only'=>['index:role.some']]);
		// $this->middleware('authorize:view_users|edit_users|create_users', ['only'=>['index','show']]);
		// $this->middleware('authorize:edit_users', ['only'=>['edit','update']]);
		// $this->middleware('authorize:create_users', ['only'=>['create','store']]);
		// $this->middleware('authorize:destroy_users', ['only'=>['destroy']]);

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
		if ($this->request->ajax()) {
			return $user;
		}
		
		return view('users.create', compact('user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(User $user)
	{
		$this->request->all();

		$this->createUser($user);

		return redirect()->route('admin.users.index')
			->withSuccess("The user $user-> has ben created!");
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
	public function update(User $user, Request $requests)
	{
		$this->updateUser($user, $requests);

		return redirect()->route('admin.users.show', $user->username)
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
		// return $user;
		$user->delete();

		return redirect()->back()
			->withWarning("User $user->name has been removed!!!");

	}

	private function createUser($user)
	{
		$user = $user->create($this->request->all());

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
		return $user->roles()->sync((array) $roles);	
	}



}
