<?php

namespace App\Http\Controllers\Dashboards;

use App\Employee;
use App\Performance;
use App\Project;
use App\Repositories\Dashboard\DataRepository;
use App\Site;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OwnerDashboardController extends DashboardAbstractController
{    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(string $role)
    {
        request()->flash();

            $data_repo = new DataRepository();
            // new up a repositorypa serve
            // 
            $data = $this->performance();
        
            return view("{$this->views_location}.{$role}", [
            'sites' => Site::orderBy('name')->select(['name'])->get(),
            'projects' => Project::orderBy('name')->select(['name'])->get(),
            'employees' => Employee::actives()->filter(request()->all())->count(),
            'revenue_mtd' => $this->mtd()->sum('revenue'),
            'login_hours_mtd' => $this->mtd()->sum('login_time'),
            'production_hours_mtd' => $this->mtd()->sum('production_time'),
            'performance' => [
                'labels' => $data->map->month,
                'revenue' => [
                    $data_repo->toArray([
                        'data' => $data->map->revenue,
                        'label' => 'Revenue'
                    ])
                ],
                'rph' => [
                    $data_repo->toArray([
                        'data' => $data->map->rph,
                        'label' => 'RPH',
                        'fill' => false
                    ])
                ],
                'login_time' => [
                    $data_repo->toArray([
                        'data' => $data->map->login_time,
                        'label' => 'Login Hours'
                    ])
                ],
                'production_time' => [
                    [
                        $data_repo->toArray([
                            'data' => $data->map->production_time,
                            'label' => 'Prod. Hours'
                        ])
                    ]
                ],
                'sph' => [
                    $data_repo->toArray([
                        'data' => $data->map->sph_goal,
                        'label' => 'Goal',
                        'borderColor' => 'rgba(211,47,47 ,1)',
                        'backgroundColor' => 'rgba(211,47,47 ,.25)',
                    ]),
                    $data_repo->toArray([
                        'data' => $data->map->sph,
                        'fill' => false,
                        'label' => 'SPH'
                    ])
                ],
                'efficiency' => [
                    $data_repo->toArray([
                        'data' => $data->map->efficiency,
                        'label' => 'Efficiency',
                        'fill' => false
                    ])
                ]
            ]
        ]);
    }

    protected function performance()
    {
        $date = Carbon::now()->subMonths(11)->startOfMonth();

        return Performance::filter(request()->all())
            ->whereDate('date', '>=', $date)
            ->select(
                DB::raw(
                    'sum(revenue) as revenue,
                    sum(login_time) as login_time,
                    sum(revenue) / sum(login_time) as rph,
                    sum(transactions) as sales,
                    sum(production_time) as production_time,
                    sum(transactions) / sum(production_time) as sph,
                    sum(production_time) / sum(login_time) as efficiency,
                    sum(sph_goal * production_time) / sum(production_time) as sph_goal,
                    DATE_FORMAT(date, "%Y-%b") as month',
                )
            )
            ->orderBy('date')
            ->groupBy('month'
            )->get();
    }
    protected function mtd()
    {
        $date = Carbon::now()->startOfMonth();

        return Performance::filter(request()->all())
            ->whereDate('date', '>=', $date)
            ->whereDate('date', '<', now());
    }
}
