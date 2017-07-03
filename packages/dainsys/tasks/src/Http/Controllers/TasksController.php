<?php

namespace Dainsys\Tasks\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dainsys\Tasks\Repositories\TasksRepository as Tasks;

class TasksController extends Controller
{
    public function index(Tasks $tasks)
    {
        return $tasks->all();
    }

    public function create()
    {
        return view('dainsys::tasks.create');
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}