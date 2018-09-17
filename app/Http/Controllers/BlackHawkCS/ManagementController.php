<?php

namespace App\Http\Controllers\BlackHawkCS;

use App\Http\Controllers\Controller;
use App\Repositories\BlackHawk_CS\Manager\Quality\Scores;
use App\Repositories\BlackHawk_CS\Manager\Quality\Errors;
use App\Repositories\BlackHawk_CS\Manager\Performance\Production;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-blackhawk-cs-management-dashboard');
        // $this->middleware('permission:view-user')->only(['index', 'show']);
        // $this->middleware('permission:create-user')->only(['create', 'store']);
        // $this->middleware('permission:edit-user')->only(['edit', 'update', 'destroy']);
    }

    public function index()
    {
        return view('blackhawk-cs.management.index');
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
