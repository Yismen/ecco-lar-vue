<?php

namespace App\Http\Controllers;

use App\Repositories\BirthdaysRepository;

class HumanResourcesController extends Controller
{

    public function birthdaysThisMonth()
    {
        $employees = BirthdaysRepository::thisMonth()->get();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays This Month!']);
    }

    public function birthdaysNextMonth()
    {
        $employees = BirthdaysRepository::nextMonth()->get();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays Next Month!']);
    }

    public function birthdaysLastMonth()
    {
        $employees = BirthdaysRepository::lastMonth()->get();

        return view('human_resources.birthdays.list_monthly', compact('employees'))->with(['title' => 'Birthdays Last Month!']);
    }
}
