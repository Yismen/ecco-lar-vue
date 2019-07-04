<?php

namespace App\Http\Controllers\Api\Performances;

use App\Supervisor;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupervisorsResource;

class SupervisorsController extends Controller
{
    public function list()
    {
        $supervisors = Supervisor::orderBy('name')->get();

        return SupervisorsResource::collection($supervisors);
    }

    public function actives()
    {
        $supervisors = Supervisor::actives()->orderBy('name')->get();

        return SupervisorsResource::collection($supervisors);
    }
}
