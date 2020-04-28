<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class EmployeeFilter extends ModelFilter
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
        return $this->filterQuery($request, __FUNCTION__);
    }

    public function project($request)
    {
        return $this->filterQuery($request, __FUNCTION__);
    }

    public function department($request)
    {
        return $this->filterQuery($request, 'position.department');
    }

    public function position($request)
    {
        return $this->filterQuery($request, __FUNCTION__);
    }

    protected function filterQuery($request, $relationship)
    {
        return $this->whereHas($relationship, function($query) use ($request) {
            if (is_array($request)) {
                $query->where('name', 'like', $request[0]);
                for ($i=1; $i < count($request); $i++) { 
                    $query->orWhere('name', 'like', $request[$i]);
                }
            } else {
                $query->where('name', 'like', $request);
            }
        });
    }
}
