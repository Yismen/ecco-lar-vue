<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;

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
            ->appends(['status' => $status, 'search' => $search]);

        return $employees;
    }

    /**
     * apply scope status if the status is defined
     * @param  string $status    the stsatus to be applied to the query
     * @param  model $employees the current employees query
     * @return query            collections of employees
     */
    private function applyScopeStatusToTheQuery($status, $employees)
    {
        if (!in_array($status, ['actives', 'inactives'])) {
            return $employees;
        }

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
        if (!$search) {
            return $employees;
        }

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

    private function handleAddLoginsToEmployee($employee, $request)
    {
        $this->validate($request, [
            'login' => 'required|unique:logins,login,NULL,id',
        ]);

        $newlogin = $employee->logins()->create($request->all());

        $loginsList = $employee->logins;

        Cache::forget('employees');

        return $newlogin;
    }
}
