<?php

namespace App\Http\Controllers\Dashboards;

use App\Repositories\Dashboard\HumanResourcesRepository;

class HumanResourcesDashboardController extends DashboardAbstractController
{    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('role:human-resource');     
    }

    public function index()
    {
        request()->flash();
        
        return view("{$this->views_location}.human_resources", HumanResourcesRepository::toArray());
    }
}
