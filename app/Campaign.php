<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name', 'project_id', 'source_id', 'revenue_type_id', 'sph_goal', 'revenue_rate'];

    public function getProjectListAttribute()
    {
        return Project::
            orderBy('name')->get();
    }

    public function getSourceListAttribute()
    {
        return Source::
            orderBy('name')->get();
    }

    public function getRevenueTypeListAttribute()
    {
        return RevenueType::
            orderBy('name')->get();
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function revenueType()
    {
        return $this->belongsTo(RevenueType::class);
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }
}
