<?php

namespace App;

use Carbon\Carbon;
use App\Traits\Trackable;
use App\Traits\PerformanceTrait;
use App\DainsysModel as Model;

class Downtime extends Model
{
    use Trackable, PerformanceTrait;

    protected $table = 'performances';

    protected $fillable = [
        'date',
        'employee_id',
        'campaign_id',
        'login_time',
        'downtime_reason_id',
        'reported_by'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $employe = Employee::with('supervisor')->findOrfail(request('employee_id'));

            $model->unique_id = request('date') . '-' . request('employee_id') . '-' . request('campaign_id'); 
            
            $model->name =  $employe->fullName;
            
            $model->file_name = request('date') . "-" . request('campaign_id') . "-downtimes-file";
            
            $model->supervisor_id =  optional($employe->supervisor)->id;
                
        });

    }
}
