<?php

namespace App\Repositories\Dashboard;

use App\Performance;
use App\Repositories\Dashboard\DataRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\PerformanceRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SiteRepository;

class OwnerRepository
{
    public function toArray()
    {
        $data_repo = new DataRepository();
        
        $performance_repo = new PerformanceRepository(new Performance());

        $data = $performance_repo->monthlyManyMonths(12);

        $mtdData = $performance_repo->monthToDateData();

        return [
            'sites' => SiteRepository::actives(),
            'projects' => ProjectRepository::actives(),
            'employees' => EmployeeRepository::actives()->count(),
            'revenue_mtd' => $mtdData->sum('revenue'),
            'login_hours_mtd' => $mtdData->sum('login_time'),
            'production_hours_mtd' => $mtdData->sum('production_time'),
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
}