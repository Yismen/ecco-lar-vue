<?php

namespace App\Repositories\SitesOverview;

use Illuminate\Http\Request;
use App\Repositories\SitesOverview\Stats\MonthlyStats;

class SitesOverviewRepository
{
    public function stats(Request $request)
    {
        return (new MonthlyStats($request))
            ->fields(
                ['revenue', 'transactions', 'contacts', 'login_time', 'production_time', 'billable_hours']
            )->get();
    }
}
