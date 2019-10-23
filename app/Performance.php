<?php

namespace App;

use App\Traits\PerformanceTrait;
use App\Traits\Trackable;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use Trackable, PerformanceTrait;

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
            $employee = Employee::findOrfail(request('employee_id'));

            $model->unique_id = request('date') . '-' . request('employee_id') . '-' . request('campaign_id');
            $model->name =  $employee->fullName;
            
        });

    }
    
}
