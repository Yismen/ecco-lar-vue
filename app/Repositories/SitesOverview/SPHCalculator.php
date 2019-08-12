<?php

namespace App\Repositories\SitesOverview;

use Illuminate\Http\Request;

class SPHCalculator
{
    protected $site;
    protected $project;
    protected $hours;
    protected $sales;
    protected $request;

    public function __construct(array $sales, array $hours, Request $request)
    {
        $this->site = $request->site ?? '%';
        $this->project = $request->project ?? '%';
        $this->hours = $hours;
        $this->sales = $sales;
    }

    public function get()
    {
        $SPH = [];

        foreach ($this->hours as $month => $hours) {
            $SPH[$month]['sph'] = $this->getSph($hours, $this->getSales($month));
            $SPH[$month]['sph_goal'] = $this->getSphGoal($month); // WIP
            $SPH[$month]['%_to_goal'] = $this->getPercToGoal($SPH[$month]['sph'], $SPH[$month]['sph_goal']);
        }

        return $SPH;
    }

    private function getSales($month)
    {
        return array_has($this->sales, $month) ? $this->sales[$month] : 0;
    }

    private function getSph($hours, $sales)
    {
        return $hours > 0 ? $sales / $hours : 0;
    }

    private function getSphGoal($month)
    {
        return (new SPHGoalForMonth($month, $this->site, $this->project))->results;
    }

    private function getPercToGoal($sph, $goal)
    {
        return $goal > 0 ? $sph / $goal * 100 : 0;
    }
}
