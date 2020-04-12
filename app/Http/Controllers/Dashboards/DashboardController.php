<?php

namespace App\Http\Controllers\Dashboards;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * List of roles to iterate. First in list is the one returned!
     *
     * @var array
     */
    protected $roles_hierarchy = [];

    protected $dashboards_namespace = 'App\\Http\\Controllers\\Dashboards\\';
    /**
     * Handle the incoming request.
     * 
     * User must have 'view-dashboard' permissions. Otherwise will be denied!
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // if(Gate::denies('view-dashboards')) {
        //     abort(401);
        // }

        $this->roles_hierarchy = config('dainsys.dashboards.roles_hierarchy');
        
        foreach ($this->roles_hierarchy as $role => $class) {
            if (auth()->user()->hasRole($role)) {
                $class_name = $this->dashboards_namespace . $class;

                $controller =  new $class_name;

                return $controller->index($role);
            }
        }

        return (new DefaultDashboardController)->index('default');
    }
}
