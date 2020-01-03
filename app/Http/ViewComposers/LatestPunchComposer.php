<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\HumanResources\Employees\Reports;
use App\Repositories\PunchRepository;

class LatestPunchComposer
{
    /**
     * The user repository implementation.
     *
     * @var Reports
     */
    protected $repo;

    /**
     * Create a new profile composer.
     *
     * @param  Reports  $reports
     * @return void
     */
    public function __construct(PunchRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'latest_punch' => $this->repo->latestPunch(),
        ]);
    }
}
