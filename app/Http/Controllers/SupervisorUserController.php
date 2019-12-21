<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupervisorUserRequest;
use App\Repositories\SupervisorUsersRepository;
use App\Supervisor;
use App\SupervisorUser;
use App\User;

class SupervisorUserController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->middleware('authorize:view-supervisor-users|edit-supervisor-users|create-supervisor-users', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-supervisor-users', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-supervisor-users', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-supervisor-users', ['only' => ['destroy']]);
        $this->middleware('authorize:assign-supervisor-users-employees', ['only' => ['reAssign']]);

        $this->repo = new SupervisorUsersRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supervisor_users.index', $this->repo->data());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisor_users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SupervisorUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupervisorUserRequest $request, SupervisorUser $supervisor_user)
    {
        $supervisor_user->syncRelationship([
            'user_ids' => $request->user_id,
            'supervisor_ids' => $request->supervisor_id
        ]);

        return redirect()
            ->route('admin.supervisor_users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SupervisorUser $supervisor_user)
    {
        $free_users = User::all();
        $free_supervisors = Supervisor::all();

        return view('supervisor_users.edit', compact('supervisor_user', 'free_users', 'free_supervisors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SupervisorUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupervisorUserRequest $request, SupervisorUser $supervisor_user)
    {
        $supervisor_user->syncRelationship([
            'user_ids' => $request->user_id,
            'supervisor_ids' => $request->supervisor_id
        ]);

        return redirect()
            ->route('admin.supervisor_users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupervisorUser $supervisor_user)
    {
        $supervisor_user->delete();

        return redirect()
            ->route('admin.supervisor_users.index');
    }
}
