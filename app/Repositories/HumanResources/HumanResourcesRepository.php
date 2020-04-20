<?php

namespace App\Repositories\HumanResources;

use App\Repositories\BirthdaysRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\HumanResources\HeadCount\BySite;
use App\Repositories\HumanResources\HeadCount\ByGender;
use App\Repositories\HumanResources\HeadCount\ByStatus;
use App\Repositories\HumanResources\HeadCount\ByProject;
use App\Repositories\HumanResources\HeadCount\ByPosition;
use App\Repositories\HumanResources\HeadCount\ByDepartment;
use App\Repositories\HumanResources\HeadCount\BySupervisor;
use App\Repositories\HumanResources\HeadCount\ByNationality;
use App\Repositories\HumanResources\Attrition\MonthlyAttrition;
use App\Repositories\HumanResources\Employees\Rotations\MonthlyRotation;
use App\Repositories\MissingInfoRepository;

class HumanResourcesRepository
{
    public function stats()
    {
        return [
            'issues' => [
                'missing_address' => MissingInfoRepository::address()->count(),
                'missing_ars' => MissingInfoRepository::ars()->count(),
                'missing_afp' => MissingInfoRepository::afp()->count(),
                'missing_bank_account' => MissingInfoRepository::bankAccount()->count(),
                'missing_nationality' => MissingInfoRepository::nationality()->count(),
                'missing_punch' => MissingInfoRepository::punch()->count(),
                'missing_supervisor' => MissingInfoRepository::supervisor()->count(),
                'missing_schedule' => MissingInfoRepository::schedules()->count(),
            ],
            'birthdays' => [
                'today' => BirthdaysRepository::today()->get(),
                'this_month' => BirthdaysRepository::thisMonth()->count(),
                'next_month' => BirthdaysRepository::nextMonth()->count(),
                'last_month' => BirthdaysRepository::lastMonth()->count(),
            ],
            'headcounts' => [
                'by_status' => (new ByStatus())->count(),
                'by_site' => EmployeeRepository::bySite()->count(),
                'by_department' => EmployeeRepository::byDepartment()->count(),
                'by_gender' => EmployeeRepository::byGender()->count(),
                'by_nationality' => EmployeeRepository::byNationality()->count(),
                'by_project' => EmployeeRepository::byProject()->count(),
                'by_position' => EmployeeRepository::byPosition()->count(),
                'by_supervisor' => EmployeeRepository::bySupervisor()->count(),
            ],
            'rotations' => [
                'monthly' => (new MonthlyRotation())->bySite()->count(6),
            ],
            'attrition' => [
                'monthly' => (new MonthlyAttrition())->bySite()->count(6),
            ],
        ];
    }
}
