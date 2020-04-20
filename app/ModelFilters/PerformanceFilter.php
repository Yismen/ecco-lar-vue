<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PerformanceFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function site($sites)
    {
        return $this->whereHas('employee.site', function($query) use ($sites) {
            if (is_array($sites)) {
                $query->where('name', 'like', $sites[0]);
                for ($i=1; $i < count($sites); $i++) { 
                    $query->orWhere('name', 'like', $sites[$i]);
                }
            } else {
                $query->where('name', 'like', $sites);
            }
        });
    }

    public function project($projects)
    {
        return $this->whereHas('employee.project', function($query) use ($projects) {
            if (is_array($projects)) {
                $query->where('name', 'like', $projects[0]);
                for ($i=1; $i < count($projects); $i++) { 
                    $query->orWhere('name', 'like', $projects[$i]);
                }
            } else {
                $query->where('name', 'like', $projects);
            }
        });
    }
}
