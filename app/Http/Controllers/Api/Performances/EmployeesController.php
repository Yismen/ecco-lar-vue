<?php

namespace App\Http\Controllers\Api\Performances;

use App\LoginName;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginNameResource;

class EmployeesController extends Controller
{
    public function loginNames()
    {
        $login_names = LoginName::with([
            'employee.supervisor',
        ])
        ->get();

        return LoginNameResource::collection($login_names);
    }
}
