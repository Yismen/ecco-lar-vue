<?php

namespace App\Repositories\Dashboard;

use App\Repositories\Dashboard\DataRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\PerformanceRepository;
use App\Site;
use App\Department;
use App\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class OwnerRepository
{
    public static function toArray()
    {
        $static = new self();

        $data_repo = new DataRepository();

        $performance_repo = new PerformanceRepository();

        $data = $performance_repo->monthlyManyMonths(12);

        $mtdData = $performance_repo->monthToDateData();

        return [
            'sites' => $static->sites(),
            'projects' => $static->projects(),
            'departments' => $static->departments(),
            'employees' => EmployeeRepository::actives()->count(),
            'revenue_mtd' => number_format($mtdData->sum('revenue'), 2),
            'login_hours_mtd' => number_format($mtdData->sum('login_time'), 2),
            'production_hours_mtd' => number_format($mtdData->sum('production_time'), 2),
            'headcounts' => [
                // 'by_site' => $static->getDataset(EmployeeRepository::bySite()),
                // 'by_project' => $static->getDataset(EmployeeRepository::byProject()),
                // 'by_gender' => $static->getDataset(EmployeeRepository::byGender()),
                // 'by_department' => $static->getDataset(EmployeeRepository::byDepartment()),
                // 'by_position' => $static->getDataset(EmployeeRepository::byPosition()),
                // 'by_supervisor' => $static->getDataset(EmployeeRepository::bySupervisor()), 
                // 'by_nationality' => $static->getDataset(EmployeeRepository::byNationality()),
            ],
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
                    $data_repo->toArray([
                        'data' => $data->map->production_time,
                        'label' => 'Prod. Hours'
                    ])
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
        ];
    }

    protected function sites()
    {
        return Cache::remember('sites-performance', now()->addHours(4), function () {
            return $this->list(new Site());
        });
    }

    protected function projects()
    {
        return Cache::remember('projects-performance', now()->addHours(4), function () {
            return $this->list(new Project());
        });
    }

    protected function departments()
    {
        return Cache::remember('departments-performance', now()->addHours(4), function () {
            return $this->list(new Department());
        });
    }

    protected function list(Model $model)
    {
        return $model->orderBy('name')->whereHas('performances')->get();
    }
}
