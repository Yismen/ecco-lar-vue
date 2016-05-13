<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Http\Requests;
use App\Http\Requests\UsersRequests;

use App\User;
use App\Role;

class UsersController extends Controller {

	public function __construct()
	{
		// $this->middleware('authorize', ['only'=>['index:role.some']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(User $users, Role $roles)
	{
		 // $message = 'No Tiene acceso a este recurso.';

   //      return redirect()->back(302)->withSuccess($message);

		$users = $users->paginate(10);

		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function edit(User $user, Role $roles)
	{
		$activeList = ['0' => 'Inactive', '1'=>'Active User'];
		$adminList = ['0' => 'Not Admin', '1'=>'Admin User'];
		$rolesList = $roles->lists('display_name', 'id');

		return view('users.edit', compact('user', 'activeList', 'adminList', 'rolesList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(User $user, UsersRequests $requests)
	{
		$this->updateUser($user, $requests);

		return redirect()->route('users.show', $user->username)
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

	public function updateUser($user, $requests)
	{
		$user->update($requests->all());

		return $this->syncRoles($user, $requests->get('roles_lists'));
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
