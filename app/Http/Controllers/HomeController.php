<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $user = auth()->user();
        if ($user && !$user->profile) {
            return redirect()->route('admin.profiles.create');
        }

        return view('app');
    }

    public function welcome()
    {
        return view('welcome');
    }
}
