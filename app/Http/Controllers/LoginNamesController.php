<?php

namespace App\Http\Controllers;

use App\Employee;
use App\LoginName;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use App\Exports\LoginName as LoginNameExport;

class LoginNamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_login_names|edit_login_names|create_login_names', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_login_names', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_login_names', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_login_names', ['only' => ['destroy']]);
        $this->middleware('authorize:export-login-names-to-excel', ['only' => ['toExcel']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $employees = Employee::select('id', 'first_name', 'second_first_name', 'last_name', 'second_last_name')
                    ->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name')
                    ->with('loginNames')
                    ->has('loginNames')
                    ->paginate(50);

        return view('login_names.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(LoginName $login)
    {
        return view('login_names.create', compact('login'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(LoginName $login, Request $request)
    {
        $this->validate($request, [
            'login' => 'required|unique:login_names',
            'employee_id' => 'required|exists:employees,id',
        ]);

        Cache::forget('employees');
        Cache::forget('login-names');

        $login->create($request->all());

        return redirect()->route('admin.login-names.index')
            ->withSuccess("LoginName $login->login has been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(LoginName $login)
    {
        return view('login_names.show', compact('login'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(LoginName $login)
    {
        return view('login_names.edit', compact('login'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(LoginName $login, Request $request)
    {
        $this->validate($request, [
            'login' => 'required|min:2|unique:login_names,login,' . $login->id,
            'employee_id' => 'sometimes|required|exists:employees,id',
        ]);

        Cache::forget('employees');
        Cache::forget('login-names');

        $login->update($request->only(['login', 'employee_id']));

        if ($request->ajax()) {
            return $login;
        }

        return redirect()->route('admin.login-names.index')
            ->withSuccess("LoginName $login->login has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(LoginName $login)
    {
        $login->delete();

        Cache::forget('employees');
        Cache::forget('login-names');

        return redirect()->route('admin.login-names.index')
            ->withDanger("LoginName $login->login has been removed.");
    }

    public function toExcel(Request $request)
    {
        return Excel::download(new LoginNameExport, 'login-names.xlsx');
    }
}
