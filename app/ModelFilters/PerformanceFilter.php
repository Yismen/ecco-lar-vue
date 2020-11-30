<?php

namespace App\ModelFilters;

class PerformanceFilter extends BaseModelFilter
{
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
}
