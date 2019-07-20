<?php

namespace App\Http\Controllers;

use App\LoginName;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Exports\LoginNameEployees;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use App\Exports\LoginName as LoginNameExport;

class LoginNamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-login-names|edit-login-names|create-login-names', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-login-names', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-login-names', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-login-names', ['only' => ['destroy']]);
        $this->middleware('authorize:export-login-names-to-excel', ['only' => ['toExcel']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view('login_names.index');
        }

        $login_names = LoginName::with('employee');

        return DataTables::of($login_names)
            ->orderColumn('employee', 'slug $1')
            ->toJson(true);
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

        return redirect()->route('admin.login_names.index')
            ->withSuccess("LoginName $login->login has been created!");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(LoginName $login)
    {
        return view('login_names.show', compact('login'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(LoginName $login)
    {
        return view('login_names.edit', compact('login'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(LoginName $login, Request $request)
    {
        $this->validate($request, [
            'login' => 'required|min:2|unique:login_names,login,'.$login->id,
            'employee_id' => 'sometimes|required|exists:employees,id',
        ]);

        Cache::forget('employees');
        Cache::forget('login-names');

        $login->update($request->only(['login', 'employee_id']));

        if ($request->ajax()) {
            return $login;
        }

        return redirect()->route('admin.login_names.index')
            ->withSuccess("LoginName $login->login has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(LoginName $login)
    {
        $login->delete();

        Cache::forget('employees');
        Cache::forget('login-names');

        return redirect()->route('admin.login_names.index')
            ->withDanger("LoginName $login->login has been removed.");
    }

    public function toExcel(Request $request)
    {
        return Excel::download(new LoginNameExport(), 'login-names.xlsx');
    }

    public function employeesToExcel(Request $request)
    {
        return Excel::download(new LoginNameEployees(), 'login-names.xlsx');
    }
}
