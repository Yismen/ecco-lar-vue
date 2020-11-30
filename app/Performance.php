<?php

namespace App;

use App\ModelFilters\FilterableTrait;
use App\Traits\PerformanceTrait;
use App\Traits\Trackable;
use App\DainsysModel as Model;

class Performance extends Model
{
    use Trackable, PerformanceTrait, FilterableTrait;

    protected $fillable = [
        'date',
        'employee_id',
        'supervisor_id',
        'login_time',
        'production_time',
        'transactions',
        'campaign_id',
        'revenue',
        // 'unique_id',
        // 'name',
        // 'sph_goal',
        // 'talk_time',
        // 'billable_hours',
        // 'contacts',
        // 'calls',
        // 'upsales',
        // 'cc_sales',
        // 'downtime_reason_id',
        // 'reported_by',
        // 'file_name'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $employee = Employee::findOrfail($model->employee_id);

            $model->unique_id = $model->date . '-' . $model->employee_id . '-' . $model->campaign_id;
            $model->name = $employee->fullName;

        });

    }

}
