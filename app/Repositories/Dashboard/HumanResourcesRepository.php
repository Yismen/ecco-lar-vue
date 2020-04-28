<?php

namespace App\Repositories\Dashboard;

use App\Repositories\AttritionRepository;
use App\Repositories\BirthdaysRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\MissingInfoRepository;
use App\Repositories\PositionRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SiteRepository;

class HumanResourcesRepository
{
    public static function toArray()
    {
        $static = new self();

        $monthly_attrition = collect(AttritionRepository::monthly());

        return [
            'sites' => SiteRepository::actives(),
            'projects' => ProjectRepository::actives(),
            'positions' => PositionRepository::actives(),
            'head_count' => EmployeeRepository::actives()->count(),
            'attrition_mtd' => AttritionRepository::mtd(),
            'hired_tm' => AttritionRepository::hiredThisMonth(),
            'terminated_tm' => AttritionRepository::terminatedThisMonth(),
            'attrition_monthly' => [
                'labels' => $monthly_attrition->map->month,
                'datasets' =>[
                    [
                        'label' => 'Head Count',
                        'data' => $monthly_attrition->map->head_count,
                        'backgroundColor' => 'rgba(2,119,189 ,0.25)',
                        'borderColor' => 'rgba(2,119,189 ,1)',
                        'borderWidth' => 1,
                        // "yAxisID" => "y1",
                    ],
                    [
                        'label' => 'Attrition',
                        'data' => $monthly_attrition->map->attrition,
                        'backgroundColor' => 'rgba(221,44,0 ,.25)',
                        'borderColor' => 'rgba(221,44,0 ,1)',
                        'type' => 'line',
                        'fill' => false,
                        // "yAxisID" => "y1",
                    ]
                ]
            ],
            
            'birthdays' => [
                'today' => BirthdaysRepository::today()->get(),
                'this_month' => BirthdaysRepository::thisMonth()->count(),
                'next_month' => BirthdaysRepository::nextMonth()->count(),
                'last_month' => BirthdaysRepository::lastMonth()->count(),
            ],

            'headcounts' => [
                'by_site' => $static->getDataset(EmployeeRepository::bySite()),
                'by_project' => $static->getDataset(EmployeeRepository::byProject()),
                'by_gender' => $static->getDataset(EmployeeRepository::byGender()),
                'by_department' => $static->getDataset(EmployeeRepository::byDepartment()),
                'by_position' => $static->getDataset(EmployeeRepository::byPosition()),
                'by_supervisor' => $static->getDataset(EmployeeRepository::bySupervisor()),
                'by_nationality' => $static->getDataset(EmployeeRepository::byNationality()),
            ],

            'issues' => [
                'missing_address' => MissingInfoRepository::address()->count(),
                'missing_punch' => MissingInfoRepository::punch()->count(),
                'missing_ars' => MissingInfoRepository::ars()->count(),
                'missing_afp' => MissingInfoRepository::afp()->count(),
                'missing_bankAccount' => MissingInfoRepository::bankAccount()->count(),
                'missing_supervisor' => MissingInfoRepository::supervisor()->count(),
                'missing_nationality' => MissingInfoRepository::nationality()->count(),
                'missing_schedules' => MissingInfoRepository::schedules()->count(),
            ]
        ];
    }

    protected function getDataset(
        $collection, $rgb = '1, 80, 175', array $options = [], $labels_name = 'name', $values_name = 'employees_count'    
    ):array
    {
        $defaults = [
            'labels' => $collection->map->$labels_name,
            'data' => $collection->map->$values_name,
            'borderColor' => "rgba({$rgb}, 1)",
            'backgroundColor' => "rgba({$rgb}, .25)",
            'fill' => true
        ];
        
        return array_merge($defaults, $options);
    }
}