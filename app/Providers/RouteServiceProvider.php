<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();

        Route::bind('afp', function ($id) {
            return \App\Afp::with(['employees' => function ($query) {
                return $query->actives()
                        ->orderBy('first_name')
                        ->orderBy('second_first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name');
            }])
            ->findOrFail($id);
        });

        Route::bind('arss', function ($id) {
            return \App\Ars::with(['employees' => function ($query) {
                return $query->actives()
                    ->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name');
            }])
            ->findOrFail($id);
        });

        Route::bind('campaign', function ($id) {
            return \App\Campaign::with(['project', 'revenueType'])
                ->findOrFail($id);
        });

        Route::bind('card', function ($card) {
            return \App\Card::whereCard($card)
                ->with('employee')
                ->firstOrFail();
        });

        Route::bind('department', function ($id) {
            return \App\Department::whereId($id)
                ->with(['positions' => function ($query) {
                    $query->orderBy('name');
                }])
                ->with(['employees' => function ($query) {
                    return $query->actives()
                        ->orderBy('first_name')
                        ->orderBy('second_first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name');
                }])
                ->firstOrFail();
        });

        Route::bind('downtime_reason', function ($id) {
            return \App\DowntimeReason::with('hours:id,downtime_reason_id,login_time,reported_by')
                ->findOrFail($id);
        });

        Route::bind('employee', function ($id) {
            return \App\Employee::whereId($id)
            ->with('address')
            ->with('afp')
            ->with('ars')
            ->with('bankAccount.bank')
            ->with('socialSecurity')
            ->with('card')
            ->with('gender')
            ->with('loginNames')
            ->with('marital')
            ->with('nationalities')
            ->with('punch')
            ->with('position')
            ->with('project')
            ->with('termination')
            ->with('supervisor')
            ->with('site')

            ->firstOrFail()
            ->append([
                'ars_list',
                'afp_list',
                'banks_list',
                'departments_list',
                'genders_list',
                'has_kids_list',
                'maritals_list',
                'positions_list',
                'projects_list',
                'payment_types_list',
                'payment_frequencies_list',
                'nationalities_list',
                'sites_list',
                'supervisors_list',
                'termination_type_list',
                'termination_reason_list'
                ]);
        });

        Route::bind('escalations_client', function ($slug) {
            return \App\EscalClient::whereSlug($slug)
                // ->with('user')
                ->firstOrFail();
        });

        Route::bind('escalations_hour', function ($id) {
            return \App\EscalationHour::with('user')
                ->with('client')
                ->findOrFail($id);
        });

        Route::bind('escalations_record', function ($id) {
            return \App\EscalRecord::with('user')
                ->with('escal_client')
                ->findOrFail($id);
        });

        Route::bind('api/escalations_record', function ($tracking) {
            return \App\EscalRecord::whereTracking($tracking)
                ->with('user')
                ->with('escal_client')
                ->firstOrFail();
        });

        Route::bind('hour', function ($id) {
            return \App\Hour::whereId($id)
                ->with(['employees' => function ($query) {
                    return $query->orderBy('first_name')
                        ->orderBy('second_first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name');
                }])
                ->firstOrFail();
        });

        Route::bind('login_name', function ($login_name) {
            return \App\LoginName::whereId($login_name)
                ->with('employee')
                ->firstOrFail();
        });

        Route::bind('menu', function ($id) {
            return \App\Menu::with('roles')
                ->findOrFail($id)
                ->append('roles-list');
        });

        Route::bind('message', function ($id) {
            return \App\Message::whereId($id)
                ->with('user')
                ->firstOrFail();
        });

        Route::bind('nationality', function ($id) {
            return \App\Nationality::with(['employees' => function ($query) {
                return $query->actives()
                    ->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name')
                    ->with('position');
            }])->findOrFail($id);
        });

        Route::bind('note', function ($slug) {
            return \App\Note::whereSlug($slug)->firstOrFail();
        });

        Route::bind('payroll-additional', function ($id) {
            return \App\PayrollAdditional::whereId($id)
                ->with('employee')
                ->firstOrFail();
        });

        Route::bind('payroll-discount', function ($id) {
            return \App\PayrollDiscount::whereId($id)
                ->with('employee')
                ->firstOrFail();
        });

        Route::bind('payroll-incentive', function ($id) {
            return \App\PayrollIncentive::whereId($id)
                ->with('employee')
                ->firstOrFail();
        });

        Route::bind('payrolls_summary', function ($id) {
            return \App\PayrollSummary::with('employee.bankAccount')
                ->with('employee.position.department')
                ->findOrFail($id);
        });

        Route::bind('performance', function ($id) {
            return \App\Performance::with('employee.supervisor')
                ->with('campaign.project')
                ->findOrFail($id);
        });

        Route::bind('permission', function ($name) {
            return \App\Permission::
                whereName($name)
                ->with('roles')
                ->firstOrFail()->append('roles-list');
        });

        Route::bind('position', function ($id) {
            return \App\Position::whereId($id)
                ->with('department')
                ->with(['employees' => function ($query) {
                    return $query->actives()
                        ->orderBy('first_name')
                        ->orderBy('second_first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name');
                }])
                ->with('payment_type')
                ->with('payment_frequency')
                ->firstOrFail();
        });

        Route::bind('project', function ($id) {
            return \App\Project::with(['employees' => function ($query) {
                return $query->actives()
                        ->orderBy('first_name')
                        ->orderBy('second_first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name');
            }])
                ->findOrFail($id);
        });

        Route::bind('punch', function ($punches) {
            return \App\Punch::wherePunch($punches)
                ->with(['employees' => function ($query) {
                    return $query->actives()
                        ->orderBy('first_name')
                        ->orderBy('second_first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name');
                }])
                ->firstOrFail();
        });

        Route::bind('quality_score', function ($id) {
            return \App\QualityScore::with('auditor', 'client', 'employee')
                ->findOrFail($id);
        });

        Route::bind('role', function ($role) {
            return \App\Role::whereName($role)
                ->with(['permissions' => function ($query) {
                    $query->orderBy('resource');
                }])
                ->with(['users' => function ($query) {
                    $query->orderBy('name');
                }])
                ->with(['menus' => function ($query) {
                    $query->orderBy('display_name');
                }])
                ->firstOrFail();
        });

        Route::bind('supervisor', function ($id) {
            return \App\Supervisor::whereId($id)
                ->with(['employees' => function ($query) {
                    return $query->actives()
                        ->orderBy('first_name')
                        ->orderBy('second_first_name')
                        ->orderBy('last_name')
                        ->orderBy('second_last_name')
                        ->with('position.department');
                }])
                ->firstOrFail();
        });

        Route::bind('site', function ($id) {
            return \App\Site::with(['employees' => function ($query) {
                return $query->actives()
                    ->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name');
            }])
                ->findOrFail($id);
        });

        Route::bind('user', function ($id) {
            return \App\User::whereId($id)
            ->with('roles.permissions')
            ->with('settings')
            ->firstOrFail()->append('roles-list');
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
