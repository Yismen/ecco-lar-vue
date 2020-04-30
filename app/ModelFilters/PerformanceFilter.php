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

    public function site($request)
    {
        return $this->filterQuery($request, "employee.site");
    }

    public function project($request)
    {
        return $this->filterQuery($request, "campaign.project");
    }

    public function department($request)
    {
        return $this->filterQuery($request, 'employee.position.department');
    }

    public function position($request)
    {
        return $this->filterQuery($request, 'employee.position');
    }

    protected function filterQuery($request, $relationship)
    {
        return $this->whereHas($relationship, function ($query) use ($request) {
            if (is_array($request)) {
                $query->where('name', 'like', $request[0]);
                for ($i = 1; $i < count($request); $i++) {
                    $query->orWhere('name', 'like', $request[$i]);
                }
            } else {
                $query->where('name', 'like', $request);
            }
        });
    }
}
