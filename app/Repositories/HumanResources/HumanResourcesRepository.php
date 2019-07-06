<?php

namespace App\Repositories\HumanResources;

use App\Repositories\HumanResources\HeadCount\BySite;
use App\Repositories\HumanResources\Issues\MissingAfp;
use App\Repositories\HumanResources\Issues\MissingArs;
use App\Repositories\HumanResources\HeadCount\ByGender;
use App\Repositories\HumanResources\HeadCount\ByStatus;
use App\Repositories\HumanResources\HeadCount\ByProject;
use App\Repositories\HumanResources\Issues\MissingPunch;
use App\Repositories\HumanResources\HeadCount\ByPosition;
use App\Repositories\HumanResources\Issues\MissingAddress;
use App\Repositories\HumanResources\HeadCount\ByDepartment;
use App\Repositories\HumanResources\HeadCount\BySupervisor;
use App\Repositories\HumanResources\Issues\MissingSchedule;
use App\Repositories\HumanResources\HeadCount\ByNationality;
use App\Repositories\HumanResources\Issues\MissingSupervisor;
use App\Repositories\HumanResources\Issues\MissingBankAccount;
use App\Repositories\HumanResources\Issues\MissingNationality;
use App\Repositories\HumanResources\Attrition\MonthlyAttrition;
use App\Repositories\HumanResources\Birthdays\Today as BirthdaysToday;
use App\Repositories\HumanResources\Employees\Rotations\LastYearRotations;
use App\Repositories\HumanResources\Employees\Rotations\ThisYearRotations;
use App\Repositories\HumanResources\Employees\Rotations\LastMonthRotations;
use App\Repositories\HumanResources\Employees\Rotations\ThisMonthRotations;
use App\Repositories\HumanResources\Birthdays\LastMonth as BirthdaysLastMonth;
use App\Repositories\HumanResources\Birthdays\NextMonth as BirthdaysNextMonth;
use App\Repositories\HumanResources\Birthdays\ThisMonth as BirthdaysThisMonth;

class HumanResourcesRepository
{
    public function stats()
    {
        return [
            'issues' => [
                'missing_address' => (new MissingAddress())->count(),
                'missing_punch' => (new MissingPunch())->count(),
                'missing_ars' => (new MissingArs())->count(),
                'missing_afp' => (new MissingAfp())->count(),
                'missing_bank_account' => (new MissingBankAccount())->count(),
                'missing_supervisor' => (new MissingSupervisor())->count(),
                'missing_nationality' => (new MissingNationality())->count(),
                'missing_schedule' => (new MissingSchedule())->count(),
            ],
            'birthdays' => [
                'today' => (new BirthdaysToday())->list(),
                'this_month' => (new BirthdaysThisMonth())->count(),
                'next_month' => (new BirthdaysNextMonth())->count(),
                'last_month' => (new BirthdaysLastMonth())->count(),
            ],
            'headcounts' => [
                'by_status' => (new ByStatus())->count(),
                'by_gender' => (new ByGender())->count(),
                'by_site' => (new BySite())->count(),
                'by_department' => (new ByDepartment())->count(),
                'by_position' => (new ByPosition())->count(),
                'by_project' => (new ByProject())->count(),
                'by_supervisor' => (new BySupervisor())->count(),
                'by_nationality' => (new ByNationality())->count(),
            ],
            'rotations' => [
                'this_month' => (new ThisMonthRotations())->count(),
                'last_month' => (new LastMonthRotations())->count(),
                'this_year' => (new ThisYearRotations())->count(),
                'last_year' => (new LastYearRotations())->count(),
            ],
            'attrition' => [
                'monthly' => (new MonthlyAttrition())->count(6),
            ],
        ];
    }
}
