<?php 

namespace App\Http\Controllers;

use App\Login;
use App\Employee;
use Carbon\Carbon;
use App\Department;
use App\Termination;
use App\ImageUploader;
use Illuminate\Http\Request;
use App\Jobs\NotifyBirthdays;
use Yajra\Datatables\Datatables;
use App\Http\Traits\EmployeesTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Intervention\Image\ImageManagerStatic as Image;
use App\Providers\EmployeeServiceProvider as EmployeeProvider;

class EmployeesController extends Controller 
{
    use EmployeesTrait;

    protected $provider;
    private $request;
    private $carbon;
    function __construct(Request $request, Carbon $carbon) {
        $this->request = $request;
        $this->carbon = $carbon;

        $this->middleware('authorize:view_employees|edit_employees|create_employees', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_employees', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_employees', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_employees', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @Get("/employees")
     * @return Response
     */

    public function index()
    {
        return view('employees.index-datatables');
    }

    public function apiEmployees(Request $request, Employee $employees)
    {
        $employees = Employee::with('position.department');
        return Datatables::of($employees)
            ->editColumn('id', function ($query) {
                return '<a href="' . route("admin.employees.show", $query->id) . '" class="">'.$query->id.'</a>';
            })
            ->addColumn('edit', function($query) {
                return '<a href="' . route("admin.employees.edit", $query->id) . '" class=""> <i class="fa fa-edit"></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Get("employees/create")
     * @return Response
     */
    public function create(Employee $employee, Department $departments)
    {
        return view('employees.create', compact('employee'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Employee $employee, Request $request)
    {
        $this->validateRequest($request, $employee);

        $employee = $employee->create($request->all());

        Cache::forget('employees');

        if ($request->ajax()) {
            return $employee;
        }
        
        return \Redirect::route('admin.employees.edit', $employee->id)
            ->withSuccess("Succesfully added employee [$request->first_name $request->last_name];");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Employee $employee, Request $request)
    {
        $this->validateRequest($request, $employee);

        $employee->update($request->all());

        Cache::forget('employees');

        if ($request->ajax()) {
            return $employee;
        }

        return redirect()->route('admin.employees.edit', $employee->id)
            ->withSuccess("Succesfully updated employee [$request->first_name $request->last_name]");

    }

    public function updateAddress(Employee $employee, Request $request)
    {
        $this->validateAddressRequest($request);

        $employee = $employee->createOrUpdateAddress($request); 

        if ($request->ajax()) {
            return $employee->load('addresses');
        }

        return redirect()->route('admin.employees.show', $employee->id)
            ->withSuccess("$employee->first_name's address updated!");

    }

    public function updateCard(Employee $employee, Request $request)
    {
        $this->validateCardRequest($request);

        $employee->createOrUpdateCard($request);        

        if ($request->ajax()) {
            return $employee->load('card');
        }

        return redirect()->route('admin.employees.show', $employee->id)
            ->withSuccess("Card Number Updated");
    }

    public function updatePunch(Employee $employee, Request $request)
    {
        $this->validate($request, [         
            'punch' => 'required|numeric|digits:5', 
        ]);

        $employee->createOrUpdatePunch($request);

        if ($request->ajax()) {
            return $employee->load('punch');
        }

        return redirect()->route('admin.employees.show', $employee->id)
            ->withSuccess("Punch ID Updated");
    }

    public function createLogin(Employee $employee, Login $login, Request $request)
    {
        $newLogin = $this->handleAddLoginsToEmployee($employee, $request);

        if ($request->ajax()) {
            return $newLogin;
        }

        return redirect()->route('admin.employees.edit', $employee->id)
            ->withSuccess("Succesfully created [$request->login]");
    }

    public function updateArs(Employee $employee, Request $request)
    {
        $employee = $this->handleUpdateArs($employee, $request);

        if ($request->ajax()) {
            return $employee;
        }
    }

    public function updateAfp(Employee $employee, Request $request)
    {
        $employee = $this->handleUpdateAfp($employee, $request);

        if ($request->ajax()) {
            return $employee;
        }
    }

    public function updateBankAccount(Employee $employee, Request $request)
    {
        $employee = $this->handleUpdateBankAccount($employee, $request);

        if ($request->ajax()) {
            return $employee;
        }
    }

    public function updateSocialSecurity(Employee $employee, Request $request)
    {
        $employee = $this->handleUpdateSocialSecurity($employee, $request);

        if ($request->ajax()) {
            return $employee;
        }
    }

    public function updateSupervisor(Employee $employee, Request $request)
    {
        $employee = $this->handleUpdateSupervisor($employee, $request);

        if ($request->ajax()) {
            return $employee;
        }
    }

    public function updateNationality(Employee $employee, Request $request)
    {
        $employee = $this->handleUpdateNationality($employee, $request);

        if ($request->ajax()) {
            return $employee;
        }
    }

    public function updateLogin(Employee $employee, Login $login, Request $request)
    {
        if ($employee->logins) {
            $employee->logins->update($request->all());
        } else {
            $login = new $login([
                'login'=>$request->input('login'), 
                'system_id'=>$request->input('system_id')
                ]);
            $employee->logins()->save($login);
        }

        if ($request->ajax()) {
            return response()->json([
                'status'  => 1, 
                'employee' => $employee, 
                'message' => "$employee->first_name's Login updated!"
                ]);
        }

        return redirect()->route('admin.employees.show', $employee->id)
            ->withSuccess("Login Number Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Employee $employee)
    {
        Cache::forget('employees');
        return $employee;

    }

    public function updatePhoto(Employee $employee, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|image|max:3000',
        ]);

        $image = new ImageUploader('images/employees/');

        $image = $image->saveImage($employee->id, $request->file('photo'));

        if ($image) {
            $now = Carbon::now()->timestamp;
            $employee->photo = '/'.$image.'?'. $now;
            $employee->save();
        } 

        if ($request->ajax()) {
            return $employee;
        }

        return redirect()->route('admin.employees.edit', $employee->id)
            ->withSuccess("$employee->first_name's photo has been updated!");
    }

    public function updateTermination(Request $request, $employee)
    { 
        $employee = $this->handleInactivation($employee, $request);

        if ($request->ajax()) {         
            return $employee;
        }

        return redirect()->route('admin.employees.edit', $employee->id)
            ->withSuccess("$employee->first_name's termination has been updated!");
    }

    public function reactivate($employee, Request $request)
    {
        $employee = $this->handleReactivation($employee, $request);

        if ($request->ajax()) {         
            return $employee;
        }       

        return redirect()->route('admin.employees.edit', $employee->id)
            ->withWarning("Employee $employee->full_name has been reactivated. Please make sure to update Hire Date field");

    }
}
