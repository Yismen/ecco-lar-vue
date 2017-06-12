<?php namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Classes\HumanResources\Lists;
use App\Http\Classes\HumanResources\Issues;
use App\Http\Classes\HumanResources\Birthdays;
use App\Http\Classes\HumanResources\Employees\Count;

class HumanResourcesController extends Controller 
{
	// use HumanResourcesIssues;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$issues = Issues::render();

		$birthdays = $this->getBirthdays();

		$by_status = [
			'actives' => Employee::actives()->count(),
			'inactives' => Employee::inactives()->count(),
		];

		$by_department = Count::byDepartment()->get();

		return view('human_resources.index', compact(
			'issues', 'birthdays', 'by_status', 'by_department'
		));
	}

	public function missingArs()
	{
		$employees = Lists::missingArs()->paginate(25);

		return view('human_resources.issues.missing_ars', compact('employees'));
	}

	public function missingAfp()
	{
		$employees = Lists::missingAfp()->paginate(25);

		return view('human_resources.issues.missing_afp', compact('employees'));
	}

	public function missingPhoto()
	{
		$employees = Lists::missingPhoto()->paginate(25);

		return view('human_resources.issues.missing_photo', compact('employees'));
	}

	public function missingAddress()
	{
		$employees = Lists::missingAddress()->paginate(25);

		return view('human_resources.issues.missing_address', compact('employees'));
	}

	public function missingPunch()
	{
		$employees = Lists::missingPunch()->paginate(25);

		return view('human_resources.issues.missing_punch', compact('employees'));
	}

	public function missingSocialSecurity()
	{
		$employees = Lists::missingSocialSecurity()->paginate(25);

		return view('human_resources.issues.missing_social_security', compact('employees'));
	}

	public function missingBankAccount()
	{
		$employees = Lists::missingBankAccount()->paginate(25);

		return view('human_resources.issues.missing_bank_account', compact('employees'));
	}

    public function getBirthdays()
    {
        return [
            'today'      => Birthdays::onDate()->get(),
            'last_month' => Birthdays::lastMonth()->count(),
            'this_month' => Birthdays::currentMonth()->count(),
            'next_month' => Birthdays::nextMonth()->count(),
        ];
    }

	public function birthdaysThisMonth()
	{
		$employees = Birthdays::currentMonth()->paginate(25);

		return view('human_resources.birthdays.this_month', compact('employees'));
	}

	public function birthdaysNextMonth()
	{
		$employees = Birthdays::nextMonth()->paginate(25);

		return view('human_resources.birthdays.next_month', compact('employees'));
	}

	public function birthdaysLastMonth()
	{
		$employees = Birthdays::lastMonth()->paginate(25);

		return view('human_resources.birthdays.last_month', compact('employees'));
	}
	
}
