<?php

namespace App;

use App\Traits\Trackable;
use App\Traits\PerformanceTrait;
use Illuminate\Database\Eloquent\Model;

class PerformanceImport extends Model
{
    use Trackable, PerformanceTrait;

    protected $table = 'performances';
    
    protected $fillable = [
        'unique_id',
        'date',
        'employee_id',
        'name',
        'campaign_id',
        'supervisor_id',
        'sph_goal',
        'login_time',
        'production_time',
        'talk_time',
        'billable_hours',
        'contacts',
        'calls',
        'transactions',
        'upsales',
        'cc_sales',
        'revenue',
        'downtime_reason_id',
        'reported_by',
        'file_name'
    ];               

    public static function removeExisting($unique_id)
    {
        $instance = new self();

        $instance->whereUniqueId($unique_id)
            ->delete();

        return $instance;
    }
}
