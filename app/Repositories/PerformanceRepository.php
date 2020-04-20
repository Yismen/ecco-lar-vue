<?php

namespace App\Repositories;

use App\Performance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PerformanceRepository
{
    protected $performance;

    public function __construct(Performance $performance)
    {
        $this->performance = $performance;
    }

    public function monthlyManyMonths(int $months = 12)
    {
        $start_of_month = Carbon::now()->subMonths($months)->startOfMonth();

        return $this->baseQeury()
            ->addSelect(DB::raw('DATE_FORMAT(date, "%Y-%b") as month'))
            ->groupBy('month')
            ->whereDate('date', '>=', $start_of_month)
            ->whereDate('date', '<', now()->today())
            ->get();
    }
    public function weeklyManyWeeks(int $weeks = 12)
    {
        $start_of_week = Carbon::now()->subWeeks($weeks)->startOfWeek();

        return $this->baseQeury()
            ->addSelect(DB::raw('DATE_FORMAT(date, "%Y-%w") as week'))
            ->groupBy('week')
            ->whereDate('date', '>=', $start_of_week)
            ->whereDate('date', '<', now()->today())
            ->get();
    }

    public function monthToDateData()
    {
        $date = Carbon::now()->subDay()->startOfMonth();

        return Performance::filter(request()->all())
            ->whereDate('date', '>=', $date)
            ->whereDate('date', '<', now()->subDay());
    }

    public function weekToDate()
    {
        $date = Carbon::now()->subDay()->startOfWeek();

        return Performance::filter(request()->all())
            ->whereDate('date', '>=', $date)
            ->whereDate('date', '<', now()->subDay());
    }

    public function downtimes()
    {
        return $this->performance
            ->with('employee', 'campaign.project', 'downtimeReason')
            ->whereHas('downtimeReason')
            ->whereHas(
                'campaign',
                function ($query) {
                    return $query->with('project')
                        ->where('name', 'like', '%downtime%')
                        ->orWhereHas('project', function ($query) {
                            return $query->where('name', 'like', '%downtime%');
                        });
                }
            );
    }

    public function datatables()
    {
        return $this->performance
            ->with(
                ['campaign.project', 'supervisor', 'employee' => function ($query) {
                    return $query->with('supervisor', 'termination');
                }]
            );
    }

    protected function baseQeury()
    {
        return Performance::filter(request()->all())
        ->select(
            DB::raw('
                sum(revenue) as revenue,
                sum(login_time) as login_time,
                sum(revenue) / sum(login_time) as rph,
                sum(transactions) as sales,
                sum(production_time) as production_time,
                sum(transactions) / sum(production_time) as sph,
                sum(production_time) / sum(login_time) as efficiency,
                sum(sph_goal * production_time) / sum(production_time) as sph_goal
            ')
        )
        ->orderBy('date');
    }
}
