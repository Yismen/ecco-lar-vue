<?php

namespace App\Http\Controllers\Dashboards;

use App\Site;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SitesOverview\SPHCalculator;
use App\Repositories\SitesOverview\SitesOverviewRepository;
use App\Repositories\HumanResources\Attrition\MonthlyAttrition;
use App\Repositories\HumanResources\Employees\Rotations\MonthlyRotation;

class SiteOverviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-sites-overview-dashboard');
    }

    public function index(Request $request)
    {
        $sites_list = array_merge(
            ['%' => '--All Sites--'],
            Site::pluck('name', 'name')->toArray()
        );

        $projects_list = array_merge(
            ['%' => '--All Projects--'],
            Project::where('name', 'not like', '%-Downtimes')->pluck('name', 'name')->toArray()
        );

        $stats = (new SitesOverviewRepository())->withSph()->stats($request);

        $stats['sph'] = (new SPHCalculator($stats['transactions'], $stats['production_time'], $request))->get();
        $stats['rotations']['monthly'] = (new MonthlyRotation())->bySite()->count(6); // This need to be filterable by the request
        $stats['attrition']['monthly'] = (new MonthlyAttrition())->bySite()->count(6); // This need to be filterable by the request

        $request->flash();

        return view('dashboards.sites_overview', compact('stats', 'sites_list', 'projects_list', 'hhrr_stats'));
    }
}
