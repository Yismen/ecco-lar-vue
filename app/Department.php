<?php

namespace App;

use App\DainsysModel as Model;

class Department extends Model
{
    protected $fillable = ['name'];

    /**
     * Update the Department name field to be ucwords
     *
     * @param  [string] $name the name name's field
     * @return string             converted string
     */
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords($name);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    /**
     * many to many relationship with the employee model
     * @return [array] [employees associated to current Department]
     */
    public function employees()
    {
        return $this->hasManyThrough(Employee::class, Position::class);
    }

    /**
     * 
     */
    public function performances()
    {
        return $this->hasManyThrough(Performance::class, Employee::class, 'id', 'employee_id');
    }

    /**
     * Return the count of employees assigned to the current name
     * @return integer Count of employees assigned to the current name
     */
    public function employees_count()
    {
        return $this->employees()->count();
    }
}
