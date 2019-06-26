<?php

namespace App\Http\Controllers;

use App\Repositories\HumanResources\Birthdays\ThisMonth as ThisMonthBirthdays;
use App\Repositories\HumanResources\Birthdays\NextMonth as NextMonthBirthdays;
use App\Repositories\HumanResources\Birthdays\LastMonth as LastMonthBirthdays;
use App\Repositories\HumanResources\HumanResourcesRepository;

class HumanResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $stats = (new HumanResourcesRepository())->stats();

        return view('human_resources.index', compact('stats'));
    }

    public function birthdaysThisMonth()
    {
        $employees = (new ThisMonthBirthdays)->list();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays This Month!']);
    }

    public function birthdaysNextMonth()
    {
        $employees = (new NextMonthBirthdays)->list();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays Next Month!']);
    }

    public function birthdaysLastMonth()
    {
        $employees = (new LastMonthBirthdays)->list();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays Last Month!']);
    }
}
