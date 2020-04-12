<?php

namespace App\Http\Controllers\Dashboards;

class AdminDashboardController extends DashboardAbstractController
{    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(string $role)
    {
        // Get the data
        return view("{$this->views_location}.{$role}", [
            'user' => auth()->user()
        ]);
    }
}
