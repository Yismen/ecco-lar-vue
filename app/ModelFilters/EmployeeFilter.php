<?php

namespace App\ModelFilters;

class EmployeeFilter extends BaseModelFilter
{
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
}
