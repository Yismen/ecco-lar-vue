<?php

namespace App\Http\Controllers\Dashboards;

use App\Repositories\Dashboard\OwnerRepository;

class OwnerDashboardController extends DashboardAbstractController
{    

    public function __construct()
    {
        $this->middleware('role:owner');     
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->flash();
        
        return view("{$this->views_location}.owner", OwnerRepository::toArray());
    }
}
