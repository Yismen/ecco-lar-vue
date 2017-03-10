<?php

namespace App\Http\Traits;

trait EmployeesTrait
{
    /**
     * Return a list of employees
     * @param  instance of Employee $employees 
     * @param  intance of Request. $request   [description]
     * @param  instance of Carbon. $carbon    [description]
     * @return Object of employees            [description]
     */
    private function getEmployees($employees, $request, $carbon)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        $employees = $this->applyScopeStatusToTheQuery($status, $employees);

        $employees = $this->applySearchScopeToTheQuery($search, $employees);
        $employees = $employees
            ->orderBy('hire_date')
            ->orderBy('first_name')
            // ->where('hire_date', '>=', $carbon->month(5))
            ->with('positions')
            // ->get();
            ->paginate(10)
            ->appends(['status'=>$status, 'search'=>$search]);

        return $employees;
            
    }

    /**
     * validates employees request against a set of rules. Prevent continues if validation fails
     * @return boolean validation passed|failed
     */
    private function validateRequest(Request $request, $employee)
    {
        return $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'hire_date' => 'required|date',
            'personal_id' => 'required_if:passport,|digits:11|unique:employees,personal_id,'.$employee->id,
            'passport' => 'required_if:personal_id,|different:personal_id|unique:employees,passport,'.$employee->id,
            'date_of_birth' => 'required|date',
            'cellphone_number' => 'required|digits:10|unique:employees,cellphone_number,'.$employee->id,
            'secondary_phone' => 'digits:10',
            'gender_id' => 'required|exists:genders,id',
            'marital_id' => 'required|exists:maritals,id',
            'has_kids' => 'required|boolean',
            'position_id' => 'required|exists:positions,id',
        ]);
    }

    /**
     * apply scope status if the status is defined
     * @param  string $status    the stsatus to be applied to the query
     * @param  model $employees the current employees query
     * @return query            collections of employees
     */
    private function applyScopeStatusToTheQuery($status, $employees)
    {
        // if (!$status) {
        //  $status = 'actives';
        // }

        if (!in_array($status, ['actives', 'inactives'])) return $employees;

        
        return $employees = $employees->$status();
        
    }

    /**
     * apply scope search if the search is defined
     * @param  string $search    the stsatus to be applied to the query
     * @param  model $employees the current employees query
     * @return query            collections of employees
     */
    private function applySearchScopeToTheQuery($search, $employees)
    {

        if (!$search) return $employees;

        $search = explode(',', $search);

        foreach ($search  as $q) {
            $q = trim($q);
            $employees = $employees
                ->orWhere('first_name', 'like', "%$q%")
                ->orWhere('last_name', 'like', "%$q%")
                ->orWhere('personal_id', 'like', "%$q%")
                ->orWhere('cellphone_number', 'like', "%$q%")
                // ->orWhere('status', '=', "$q")
                // ->orWhereHas('positions.name', 'like', "%$q%")
                ->orWhere('secondary_phone', 'like', "%$q%")
                ->orWhere('id', 'like', $q);
        }
        
        return $employees;
        
    }

    private function appyDatesScopesToTheQuery($search, $employees, $carbon)
    {

    }

    protected function validateAddressRequest($request)
    {
        $this->validate($request, [
            'sector'         => 'required',
            'street_address' => 'required',
            'city'           => 'required',     
        ]);

        return $this;
    }

    protected function validateCardRequest($request)
    {
        $this->validate($request, ['card'=> 'required|numeric|digits:8|']);
        return $this;
    }
}