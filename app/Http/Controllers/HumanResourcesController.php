<?php

namespace App\Http\Controllers;

use App\Repositories\HumanResources\Birthdays\BirthdaysThisMonth;
use App\Repositories\HumanResources\Birthdays\BirthdaysNextMonth;
use App\Repositories\HumanResources\Birthdays\BirthdaysLastMonth;
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
        $employees = (new BirthdaysThisMonth())->list();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays This Month!']);
    }

    public function birthdaysNextMonth()
    {
        $employees = (new BirthdaysNextMonth())->list();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays Next Month!']);
    }

    public function birthdaysLastMonth()
    {
        $employees = (new BirthdaysLastMonth())->list();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays Last Month!']);
    }
}
