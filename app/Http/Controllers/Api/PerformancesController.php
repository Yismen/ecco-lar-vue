<?php

namespace App\Http\Controllers\Api;

use App\Project;
use App\Campaign;
use App\Employee;
use App\LoginName;
use Carbon\Carbon;
use App\Performance;
use App\DowntimeReason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\DowntimesResource;
use App\Http\Resources\LoginNameResource;
use App\Http\Resources\PerformanceResource;
use App\Http\Resources\DowntimeReasonsResource;

class PerformancesController extends Controller
{
    public function performanceData(Request $request, int $many = 3)
    {
        $many--;

        $many =  $many <= 0 ? 0 : $many;

        ini_set('memory_limit', config('dainsys.memory_limit'));
        ini_set('max_execution_time', 240);

        $start_of_month = Carbon::now()->subMonths($many)->startOfMonth();

        $project = $request->has('project') ? '%' . $request->get('project') . '%' : '%';

        $performances = Performance::with(['supervisor', 'downtimeReason'])
            ->with(['campaign' => function ($query) {
                return $query->with(['source', 'project']);
            }])
            ->with(['employee' => function ($query) {
                return $query
                    ->with(['supervisor', 'site', 'termination', 'position.department', 'project', 'punch']);
            }])
            ->whereDate('date', '>=', $start_of_month)
            ->whereHas('campaign', function ($query) use ($project) {
                return $query->whereHas('project', function ($query) use ($project) {
                    return $query->where('name', 'like', $project);
                });
            })
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
        $projects = Employee::with('supervisor')->get();

        return EmployeeResource::collection($projects);
    }

    public function downtimes()
    {
        $downtimes = Performance::with('campaign.project', 'downtimeReason', 'employee')
        ->whereHas('campaign', function ($query) {
            return $query->whereHas('project', function ($query) {
                return $query->where('name', 'like', '%downtimes%');
            })
            ->orWhere('name', 'like', '%downtimes%');
        })
        ->get();

        return DowntimesResource::collection($downtimes);
    }

    public function downtimeReasons()
    {
        $downtime_reasons = DowntimeReason::get();

        return DowntimeReasonsResource::collection($downtime_reasons);
    }
}
