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

        $data = (new OwnerRepository)->toArray();
        // atrition, rotation, hc by gender, hc by department, hc by position, hc by supervisor
        // dd($data);
        return view("{$this->views_location}.owner", $data);
    }
}
