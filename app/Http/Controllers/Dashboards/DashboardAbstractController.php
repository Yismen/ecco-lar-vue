<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;

abstract class DashboardAbstractController extends Controller 
{    
    protected $views_location = 'dashboards';

    abstract function index(string $role);
}
