<?php

namespace App\Http\Controllers\Dashboards;

use App\Repositories\Dashboard\AdminRepository;

class AdminDashboardController extends DashboardAbstractController
{
    /**
     * Constructtor.
     * 
     * Limit access by applying middlerware
     */
    public function __construct()
    {
        $this->middleware('role:admin');
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

        return view("{$this->views_location}.admin", AdminRepository::toArray());
    }
}
