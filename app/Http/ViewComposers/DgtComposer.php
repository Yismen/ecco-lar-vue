<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\HumanResources\Employees\Reports;

class DgtComposer
{
    /**
     * The user repository implementation.
     *
     * @var Reports
     */
    protected $reports;

    /**
     * Create a new profile composer.
     *
     * @param  Reports  $reports
     * @return void
     */
    public function __construct(Reports $reports)
    {
        // Dependencies automatically resolved by service container...
        $this->reports = $reports;
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
            'years' => $this->reports->last_five_years,
            'months' => $this->reports->months_of_the_year,
        ]);
    }
}
