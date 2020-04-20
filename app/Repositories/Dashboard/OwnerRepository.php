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
                        'data' => $data->map(function($data) {
                            return number_format($data->revenue, 2);
                        }),
                        'label' => 'Revenue'
                    ])
                ],
                'rph' => [
                    $data_repo->toArray([
                        'data' => $data->map(function($data) {
                            return number_format($data->rph, 2);
                        }),
                        'label' => 'RPH',
                        'fill' => false
                    ])
                ],
                'login_time' => [
                    $data_repo->toArray([
                        'data' => $data->map(function($data) {
                            return number_format($data->login_time, 2);
                        }),
                        'label' => 'Login Hours'
                    ])
                ],
                'production_time' => [
                    $data_repo->toArray([
                        'data' => $data->map(function($data) {
                            return number_format($data->production_time, 2);
                        }),
                        'label' => 'Prod. Hours'
                    ])
                ],
                'sph' => [
                    $data_repo->toArray([
                        'data' => $data->map(function($data) {
                            return number_format($data->sph_goal, 2);
                        }),
                        'label' => 'Goal',
                        'borderColor' => 'rgba(211,47,47 ,1)',
                        'backgroundColor' => 'rgba(211,47,47 ,.25)',
                    ]),
                    $data_repo->toArray([
                        'data' => $data->map(function($data) {
                            return number_format($data->sph, 2);
                        }),
                        'fill' => false,
                        'label' => 'SPH'
                    ])
                ],
                'efficiency' => [
                    $data_repo->toArray([
                        'data' => $data->map(function($data) {
                            return number_format($data->efficiency, 2);
                        }),
                        'label' => 'Efficiency',
                        'fill' => false
                    ])
                ]
            ]
        ];
    }
}