<?php

namespace App\Http\Traits;

use App\Ars;
use App\Termination;
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
     * validates employees request against a set of rules. Prevent continues if validation fails
     * @return boolean validation passed|failed
     */
    private function validateRequest($request, $employee)
    {
        $id = $employee->id ?? 0;
        return $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'hire_date' => 'required|date',
            'personal_id' => 'required_if:passport,|nullable|digits:11|unique:employees,personal_id,' . $id .'|size:11',
            'passport' => 'required_if:personal_id,|nullable|unique:employees,passport,' . $id .'|size:10',
            'date_of_birth' => 'required|date',
            'cellphone_number' => 'required|digits:10|unique:employees,cellphone_number,' . $id,
            'secondary_phone' => 'nullable|digits:10',
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

    protected function validateCardRequest($request)
    {
        $this->validate($request, ['card' => 'required|numeric|digits:8|']);
        return $this;
    }

    protected function handleInactivation($employee, $request)
    {
        $this->validate($request, [
            'termination_date' => 'required|date',
            'termination_type_id' => 'required|integer|exists:termination_types,id',
            'termination_reason_id' => 'required|integer|exists:termination_reasons,id',
            'can_be_rehired' => 'required|boolean',
        ]);

        Termination::whereEmployeeId($employee->id)->delete();

        $termination = new Termination($request->only([
            'termination_date', 'termination_type_id', 'termination_reason_id', 'can_be_rehired', 'comments'
        ]));

        $employee->termination()->save($termination);

        return $employee->load('termination');
    }

    private function handleReactivation($employee, $request)
    {
        $this->validate($request, [
            'hire_date' => 'required|date',
        ]);

        if ($employee->termination) {
            $employee->termination->delete();
        }

        $employee->update($request->only(['hire_date']));

        return $employee->load('termination');
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

    private function handleUpdateArs($employee, $request)
    {
        $this->validate($request, [
            'ars_id' => 'required|exists:ars,id',
        ]);

        $employee->ars_id = $request->ars_id;
        $employee->save();

        Cache::forget('employees');

        return $employee->load('ars');
    }

    private function handleUpdateAfp($employee, $request)
    {
        $this->validate($request, [
            'afp_id' => 'required|exists:afps,id',
        ]);

        $employee->afp_id = $request->afp_id;
        $employee->save();

        Cache::forget('employees');

        return $employee->load('afp');
    }

    private function handleUpdateBankAccount($employee, $request)
    {
        $hasAccount = $employee->bankAccount()->count() > 0 ? true : false;
        $account_id = $hasAccount ? $employee->bankAccount->id : null;

        $this->validate($request, [
            'bank_id' => 'required|exists:banks,id',
            'account_number' => 'required|min:5|max:100|unique:bank_accounts,account_number,' . $account_id,
        ]);

        if ($hasAccount) {
            $employee->bankAccount()->update($request->all());
        } else {
            $employee->bankAccount()->create($request->all());
        }

        Cache::forget('employees');

        return $employee;
    }

    private function handleUpdateSocialSecurity($employee, $request)
    {
        $hasSocial = $employee->socialSecurity()->count() > 0 ? true : false;
        $social_id = $hasSocial ? $employee->socialSecurity->id : null;

        $this->validate($request, [
            'number' => 'required|min:5|max:10|unique:social_securities,number,' . $social_id,
        ]);

        if ($hasSocial) {
            $employee->socialSecurity()->update($request->all());
        } else {
            $employee->socialSecurity()->create($request->all());
        }

        Cache::forget('employees');

        return $employee;
    }

    private function handleUpdateNationality($employee, $request)
    {
        $this->validate($request, [
            'nationality_id' => 'required|exists:nationalities,id',
        ]);

        $nationality = $request->nationality_id;

        $employee->nationalities()->sync([$request->nationality_id]);

        return $employee;
    }

    private function handleUpdateSupervisor($employee, $request)
    {
        $this->validate($request, [
            'supervisor_id' => 'required|exists:supervisors,id',
        ]);

        $employee->supervisor_id = $request->supervisor_id;
        $employee->save();

        Cache::forget('employees');

        return $employee->load('supervisor');
    }
}
