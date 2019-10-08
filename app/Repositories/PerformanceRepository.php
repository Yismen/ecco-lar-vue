<?php

namespace App\Repositories;

use App\Performance;

class PerformanceRepository
{
    protected $performance;

    public function __construct(Performance $performance)
    {
        $this->performance = $performance;
    }

    public function recents()
    {
        return $this->performance
            ->orderBy('updated_at', 'desc')
            ->with('employee.termination', 'campaign.project')
            ->whereHas(
                'campaign', function ($query) {
                    return $query->with('project')
                        ->where('name', 'like', '%downtime%')
                        ->orWhereHas('project', function ($query) {
                            return $query->where('name', 'like', '%downtime%');
                        });
                }
            )
            ->take(50)
            ->get();
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
}
