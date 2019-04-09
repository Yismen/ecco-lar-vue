<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['unique_id', 'date', 'employee_id', 'name', 'campaign_id', 'supervisor_id', 'sph_goal', 'login_time', 'production_time', 'talk_time', 'billable_hours', 'contacts', 'calls', 'transactions', 'revenue'];

    public static function removeExisting($unique_id)
    {
        $instance = new self;

        $instance->whereUniqueId($unique_id)
            ->delete();

        return $instance;
    }

}
