<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\Request;
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('authorize');
    }

    public function index(Task $tasks, Request $request)
    {
        $tasks = $tasks
                // ->pending()
                ->foruser()
                ->latest()
                ->paginate(25);

        if ($request->ajax()) {
            return $tasks;
        }

        return view('tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Task $task)
    {
        return view('tasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Task $task, Request $request)
    {
        $this->validate($request, [
            'task_name' => 'required|min:5',
        ]);
        $task = auth()->user()->tasks()->create($request->all());

        if ($request->ajax()) {
            return $task;
        }

        return \Redirect::route('tasks.index')->withSuccess("Your task [$request->task_name] has been created;");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Task $task, Request $request)
    {
        return $request->all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Task              $task    [Model Object]
     * @param  Request $request [Request object]
     * @return [redirect]                 [Response]
     */
    public function update(Task $task, Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'completed' => 'required|boolean',
        ]);

        $task->update($request->all());

        if ($request->ajax()) {
            return $task;
        }

        return redirect()->back()->withError('Only ajax allowed...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $task
     * @return Response
     */
    public function destroy(Task $task, Request $request)
    {
        $task->delete();

        if ($request->ajax()) {
            return $task;
        }

        return redirect()->back()->withWarning("Your task [$task->task_name] has been removed");
    }

    /**
     * Update / toggle the task as completed
     *
     * @return [type] [description]
     */
    public function removeCompleted(Task $tasks, Request $request)
    {
        $tasks = $tasks->whereCompleted(true)->get();

        foreach ($tasks as $task) {
            $task->delete();
        }
        if ($request->ajax()) {
            return $tasks;
        }

        return redirect()->back()->withError('Only ajax allowed...');
    }

    public function getAjaxRemoveCompleted()
    {
        if (\Input::has('removeAll')) {
            $task = Task::completed()->foruser()->delete();
        }

        return $task;
    }
}
