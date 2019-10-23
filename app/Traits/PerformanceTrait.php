<?php

namespace App\Traits;

use App\Campaign;
use App\DowntimeReason;
use App\Employee;
use App\Supervisor;
use Carbon\Carbon;

trait PerformanceTrait
{
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function downtimeReason()
    {
        return $this->belongsTo(DowntimeReason::class);
    }

    public function getEmployeesListAttribute()
    {
        return Employee::orderBy('first_name')
            ->orderBy('second_first_name')
            ->get();
    }

    public function getEmployeeRecentsListAttribute()
    {
        return Employee::orderBy('first_name')
            ->orderBy('second_first_name')
            ->recents(Carbon::now()->subMonth())
            ->get();
    }

    public function getDowntimesCampaignsListAttribute()
    {
        return Campaign::orderBy('name')->where(
            'name',
            'like',
            '%downtimes%'
        )->get();
    }


    public function getCampaignsListAttribute()
    {
        return Campaign::orderBy('name')->get();
    }

    public function getDowntimesReasonsListAttribute()
    {
        return DowntimeReason::orderBy('name')->get();
    }

    public function getSupervisorsListAttribute()
    {
        return Supervisor::orderBy('name')->get();
    }

    public function getActiveSupervisorsListAttribute()
    {
        return Supervisor::orderBy('name')->actives()->get();
    }
}