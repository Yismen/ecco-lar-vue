<?php

namespace App\Http\Controllers\Api;

use App\Project;
use App\Campaign;
use App\Employee;
use App\LoginName;
use App\Performance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\LoginNameResource;
use App\Http\Resources\PerformanceResource;

class PerformancesController extends Controller
{
    public function performanceData()
    {
        $performances = Performance::with([
            'supervisor'
        ])
        ->with(['campaign' => function ($query) {
            return $query->with(['source', 'project']);
        }])
        ->with(['employee' => function ($query) {
            return $query
                ->with('site')
                ->with([
                    'supervisor'
                ])
                ->with(['position' => function ($query) {
                    return $query->with('department');
                }]);
        }])
        ->get();

        return PerformanceResource::collection($performances);
    }

    public function loginNames()
    {
        $login_names = LoginName::with([
            'employee.supervisor',
        ])
        ->get();

        return LoginNameResource::collection($login_names);
    }

    public function campaigns()
    {
        $campaigns = Campaign::with([
            'project',
            'source',
            'revenueType',
        ])
            ->get();

        return CampaignResource::collection($campaigns);
    }

    public function employees()
    {
        $projects = Employee::get();

        return EmployeeResource::collection($projects);
    }
}
