<?php

namespace App\Repositories\SitesOverview;

use Illuminate\Http\Request;
use App\Repositories\SitesOverview\Stats\MonthlyStats;

class SitesOverviewRepository
{
    protected $with_sph = false;

    public function stats(Request $request)
    {
        return (new MonthlyStats($request))
            ->fields(
                ['revenue', 'transactions', 'contacts', 'login_time', 'production_time', 'billable_hours', 'talk_time']
            )->get();
    }

    public function withSph()
    {
        $this->with_sph = true;

        return $this;
    }
}
