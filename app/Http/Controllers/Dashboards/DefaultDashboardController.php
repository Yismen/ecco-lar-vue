<?php

namespace App\Http\Controllers\Dashboards;

use App\Employee;
use App\Profile;
use App\Project;
use App\Site;
use App\User;
use Illuminate\Support\Facades\Cache;
use App\Repositories\HumanResources\Birthdays\BirthdaysToday;

class DefaultDashboardController extends DashboardAbstractController
{    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(string $role)
    {
        return view("{$this->views_location}.{$role}", [
            'user' => auth()->user(),
            'app_name' => ucwords(config('dainsys.app_name', 'Dainsys')),
            'users_count' => User::count(),
            'employees_count' => Employee::actives()->count(),
            'profiles' => Profile::latest()->take(6)->get(),
            'sites' => Cache::remember('active_sites', 60, function () {
                return Site::whereHas('employees', function ($query) {
                    return $query->actives();
                })->count();
            }),
            'projects' => Cache::remember('active_projects', now()->addHour(), function () {
                return Project::whereHas('employees', function ($query) {
                    return $query->actives();
                })->count();
            }),
            'birthdays' => Cache::remember('active_birthdays', now()->addHour(), function () {
                return (new BirthdaysToday())->list();
            }),
        ]);
    }
}
