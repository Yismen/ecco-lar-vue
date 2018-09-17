<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportsController extends Controller
{
    protected $importErrors = [];

    public function home()
    {
        return view('imports.home');
    }

    public function employees()
    {
        return view('imports.employees');
    }

    public function handleImportEmployees(Request $request, Employee $employee)
    {
        $this->validateFiles($request);

        return $data  = $this->importDataFromExcel($request->file('excel_file'));

        foreach ($data as $row) {
            $employee = $this->deleteIfExists($row);

            $employee->id                = $row->id;
            $employee->first_name        = $row->first_name;
            $employee->second_first_name = $row->second_first_name;
            $employee->last_name         = $row->last_name;
            $employee->second_last_name  = $row->second_last_name;
            $employee->hire_date         = $row->hire_date;
            $employee->personal_id       = $row->personal_id;
            $employee->passport          = $row->passport;
            $employee->date_of_birth     = $row->date_of_birth;
            $employee->cellphone_number  = $row->cellphone_number;
            $employee->secondary_phone   = $row->secondary_phone;
            $employee->gender_id         = $row->gender_id;
            $employee->marital_id        = $row->marital_id;
            $employee->has_kids          = $row->has_kids;
            $employee->position_id       = $row->position_id;
            $employee->supervisor_id     = $row->supervisor_id;
            $employee->afp_id            = $row->afp_id;
            $employee->ars_id            = $row->ars_id;
            $employee->photo             = $row->photo;

            $employee =  $employee->save();
        }

        return $data;
    }

    protected function validateFiles($request)
    {
        $this->validate($request, [
            'excel_file' => 'required|file'  //validate as csv or excel file
        ]);
    }

    protected function importDataFromExcel($file)
    {
        return $data = Excel::load($file, 'UTF-8')->toObject();
    }

    protected function deleteIfExists($row)
    {
        $employee = Employee::whereId($row->id)->first();

        if ($employee) {
            $employee->delete();
        }

        return new Employee;
    }
}
