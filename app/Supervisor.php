<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $fillable = ['name', 'department_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function getDepartmentsListAttribute()
    {
        return Department::pluck('department', 'id');
    }
    
    /**
     * =======================================
     * Mutators
     */
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords(trim($name));
    }
}
