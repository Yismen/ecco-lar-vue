<?php

namespace App;

use App\DainsysModel as Model;
use Cviebrock\EloquentSluggable\Sluggable;

class LoginName extends Model
{
    use Sluggable;
    protected $fillable = ['login', 'employee_id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'employee.fullName',
                'onUpdate' => true,
            ],
        ];
    }

    /**
     * -------------------------------------------------------
     * Relatioships.
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    /**
     * --------------------------------------------
     * Accessors.
     */
    public function getEmployeesListAttribute()
    {
        return Employee::select('id', 'first_name', 'second_first_name', 'last_name', 'second_last_name')
                    ->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name')
                    ->get()
                    ->pluck('fullName', 'id');
    }
}
