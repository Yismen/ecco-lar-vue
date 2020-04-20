<?php

namespace App\Http\Controllers\Dashboards;

use App\Employee;
use App\Profile;
use App\Repositories\BirthdaysRepository;
use App\User;
use App\Repositories\ProjectRepository;
use App\Repositories\SiteRepository;

class DefaultDashboardController extends DashboardAbstractController
{    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("{$this->views_location}.default", [
            'user' => auth()->user(),
            'app_name' => ucwords(config('dainsys.app_name', 'Dainsys')),
            'users_count' => User::count(),
            'employees_count' => Employee::actives()->count(),
            'profiles' => Profile::latest()->take(6)->get(),
            'sites' => SiteRepository::actives()->count(),
            'projects' => ProjectRepository::actives()->count(),
            'birthdays' => BirthdaysRepository::today()->get(),
        ]);
    }
}
