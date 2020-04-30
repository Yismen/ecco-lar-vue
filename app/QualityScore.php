<?php

namespace App;

use App\DainsysModel as Model;

class QualityScore extends Model
{
    /**
     * Fields allowed for mass assignment. Only these can be updated thru the model.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'employee_id', 'work_date', 'score', 'unique_id'];
    /**
     * Attributes to present on each class instance
     *
     * @var array
     */
    // protected $appends = ['clients_list', 'employees_list'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getClientsListAttribute()
    {
        return Client::pluck('name', 'id');
    }

    public function getEmployeesListAttribute()
    {
        return Employee::select('first_name', 'second_first_name', 'last_name', 'second_last_name', 'id')->orderBy('first_name')->get()->pluck('full_name', 'id');
    }
}
