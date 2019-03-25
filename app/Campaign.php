<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name', 'project_id', 'revenue_type_id', 'sph_goal', 'revenue_rate'];

    public function getProjectListAttribute()
    {
        return Project::get();
    }

    public function getRevenueTypeListAttribute()
    {
        return RevenueType::get();
    }
}
