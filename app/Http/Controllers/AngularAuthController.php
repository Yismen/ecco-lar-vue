<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AngularAuthController extends Controller {

	public function login()
	{
		if (\Auth::attempt(['email' => \Request::json('email'), 'password' => \Request::json('password')])) {
			return response()->json(sha1(\Auth::user()->id));
		} else {
			// return Response::json(['flash' => 'Invalid username or Password']);
			return response(['flash' => 'Invalid username or Password'], 500);
		}
	}

	public function logout()
	{
		\Auth::logout();
		return response(['flash' => 'You have been logged out!']);
	}	

}
