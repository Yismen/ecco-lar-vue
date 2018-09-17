<?php

namespace App\Http\Controllers\Blackhawk\DE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Blackhawk\DE\Management\Dashboard;

class ManagementController extends Controller
{
    public function dashboard()
    {
        return view('blackhawk.de.management.dashboard');
    }

    public function dashboardData()
    {
        return Dashboard::dashboard('Comcast');
    }
}
