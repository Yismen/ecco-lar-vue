<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateTaskRequest;
use App\Task;


class TasksController extends Controller {

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

	public function index(Task $tasks)
	{
		$tasks = $tasks->foruser()->paginate(10);
		
		return view('tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Task $task, CreateTaskRequest $request)
	{
		// $request['user_id'] = $request>user()->id;
		$request['user_id'] = \Auth::id();
		$task->create($request->all());

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
	public function edit(Task $task,  CreateTaskRequest $request)
	{
		return $request->all();
	}

	/**
	 * Update the specified resource in storage.
	 * 
	 * @param  Task              $task    [Model Object]
	 * @param  CreateTaskRequest $request [Request object]
	 * @return [redirect]                 [Response]
	 */
	public function update(Task $task,  CreateTaskRequest $request)
	{
		return $request;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  object  $task
	 * @return Response
	 */
	public function destroy(Task $task)
	{
		$executed = $task->destroy($task->id);

		if ( \Input::ajax() ) {
			return $executed;
		}

		return redirect()->back()->withWarning("Your task [$task->task_name] has been removed");
	}

	/**
	 * Update / toggle the task as completed
	 * 
	 * @return [type] [description]
	 */
	public function getAjaxUpdate()
	{
		if ( \Input::ajax() ) {
			$task = Task::find(\Input::get('parentId'));

			$task->completed = \Input::get('elemVal', 0);

			$task->save();

			return $task;
		} else {
			return redirect()->back()->withError("Only ajax allowed...");
		}		

	}
	
	public function getAjaxRemoveCompleted()
	{
		if ( \Input::has('removeAll')) {
			$task = Task::completed()->foruser()->delete();
		}

		return $task;
	}

}
