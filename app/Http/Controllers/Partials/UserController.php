<?php

namespace App\Http\Controllers\Partials;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::where('name', 'like', "%" . request('q') . "%")->get();

        return view('partials._users', [
            'users' => $users
        ]);
    }
}
