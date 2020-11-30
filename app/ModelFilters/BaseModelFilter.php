<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

abstract class BaseModelFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];
    
    /**
     * Apply filter to the $query builder
     *
     * @param Array/string $request
     * @param EloquentRelationship $relationship
     * @param String $quey_field
     * @return QueryBuilder
     */
    protected function filterQuery($request, $relationship, $quey_field = 'name')
    {
        return $this->whereHas($relationship, function ($query) use ($request, $quey_field) {
            if (is_array($request)) {
                $query->where($quey_field, 'like', $request[0]);
                for ($i=1; $i < count($request); $i++) {
                    $query->orWhere($quey_field, 'like', $request[$i]);
                }
            } else {
                $query->where($quey_field, 'like', $request);
            }
        });
    }
}
