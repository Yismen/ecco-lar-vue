<?php

namespace App\Http\Controllers\Api\Performances;

use Carbon\Carbon;
use App\Performance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DowntimesResource;
use App\Http\Resources\PerformanceResource;

class PerformancesController extends Controller
{
    public function data(Request $request, int $many = 3)
    {
        --$many;

        $many = $many <= 0 ? 0 : $many;

        ini_set('memory_limit', config('dainsys.memory_limit'));
        ini_set('max_execution_time', 240);

        $start_of_month = Carbon::now()->subMonths($many)->startOfMonth();

        $project = $request->has('project') ? $request->get('project') : '%';
        $campaign = $request->has('campaign') ? $request->get('campaign') : '%';

        $performances = Performance::with(['supervisor', 'downtimeReason'])
            ->with(['campaign' => function ($query) {
                return $query->with(['source', 'project']);
            }])
            ->with(['employee' => function ($query) {
                return $query
                    ->with(['supervisor', 'site', 'termination', 'position.department', 'project', 'punch']);
            }])
            ->whereDate('date', '>=', $start_of_month)
            ->whereHas('campaign', function ($query) use ($project, $campaign) {
                return $query->where('name', 'like', $campaign)->whereHas('project', function ($query) use ($project) {
                    return $query->where('name', 'like', $project);
                });
            })
            ->get();

        return PerformanceResource::collection($performances);
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
            ->orderBy('date')
            ->whereDate('date', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->get();

        return DowntimesResource::collection($downtimes);
    }
}
