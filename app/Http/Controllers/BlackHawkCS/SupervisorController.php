<?php

namespace App\Http\Controllers\BlackHawkCS;

use App\Http\Controllers\Controller;
use App\Repositories\BlackHawk_CS\Supervisor\Quality\Scores;
use App\Repositories\BlackHawk_CS\Supervisor\Quality\Errors;
use App\Repositories\BlackHawk_CS\Supervisor\Performance\Production;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-blackhawk-cs-supervisor-dashboard');
        // $this->middleware('permission:view-user')->only(['index', 'show']);
        // $this->middleware('permission:create-user')->only(['create', 'store']);
        // $this->middleware('permission:edit-user')->only(['edit', 'update', 'destroy']);
    }

    public function index()
    {
        return view('blackhawk-cs.supervisor.index');
    }

    public function dashboard(Scores $quality, Errors $errors, Production $production)
    {
        return [
            'quality' => $quality,
            'errors' => $errors,
            'production' => $production,
        ];
    }
}
