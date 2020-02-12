<?php

namespace App\Http\Controllers\Attendance;

use App\AttendanceCode;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Attendances\AttendanceEmployeesRepository;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function show(Request $request, Employee $employee)
    {
        $repo = new AttendanceEmployeesRepository($employee->id);

        return view('attendances._by_employees', ['data' => $repo->data(), 'employee' => $employee]);
    }
}
