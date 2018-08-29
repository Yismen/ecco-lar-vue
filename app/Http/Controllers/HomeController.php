<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use GrahamCampbell\Flysystem\Facades\Flysystem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth')->only();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flysystem $flysystem)
    {
    	// return $flysystem->get('menu-items.txt');
        $user = auth()->user();
        if ($user && !$user->profile) {
            return redirect()->route('admin.profiles.create');
        }

        return view('welcome');
    }
}
