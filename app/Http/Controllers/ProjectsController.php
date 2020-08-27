<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-projects|edit-projects|create-projects', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-projects', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-projects', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-projects', ['only' => ['destroy']]);
    }

    public function index()
    {
        $projects = Project::with(['client', 'employees' => function ($query) {
            // give it the possition
            return $query->orderBy('first_name')
                ->orderBy('second_first_name')
                ->orderBy('last_name')
                ->orderBy('second_last_name')
                ->with('supervisor', 'nationality')
                ->with(['position' => function ($query) {
                    return $query->with(['department', 'payment_type']);
                }])
                ->actives();
        }])
            ->orderBy('name')
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new reproject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();

        return view('projects.create', compact('project'));
    }

    /**
     * Store a newly created reproject in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:projects',
            'client_id' => 'required|exists:clients,id'
        ]);

        $project = $project->create($request->only(['name', 'client_id']));

        return redirect()->route('admin.projects.index')
            ->withSuccess('Project ' . $project->name . ' created');
    }

    /**
     * Display the specified reproject.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified reproject.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified reproject in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:projects,name,' . $project->id,
            'client_id' => 'required|exists:clients,id'
        ]);

        $project->update($request->only(['name', 'client_id']));

        return redirect()->route('admin.projects.index', $project->id)
            ->withWarning("Project $project->name has been updated");
    }

    /**
     * Remove the specified reproject from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    public function assignEmployees(Request $request)
    {
        $this->validate($request, [
            'employee' => 'required|array',
            'project' => 'required|exists:projects,id',
        ], [
            'employee.required' => 'Select at least one employee!',
        ]);

        foreach ($request->employee as  $id) {
            $employee = Employee::whereId($id)->first();

            $employee->update(['project_id' => $request->project]);
        }

        return redirect()->route('admin.projects.index')
            ->withSuccess('Done!');
    }
}
