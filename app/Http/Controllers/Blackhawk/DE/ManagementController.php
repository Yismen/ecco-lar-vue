<?php

namespace App\Http\Controllers\Blackhawk\DE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function dashboard()
    {
        return view('blackhawk.de.management.dashboard');
    }
}
