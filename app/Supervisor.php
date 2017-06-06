<?php namespace App;

use App\Department;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model {

    protected $appends = ['departments_list'];

    protected $fillable = ['name', 'department_id'];

	/**
     * ==========================================
     * Relationships
     */
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    
    /**
     * ========================================
     * Methods
     */
    
    /**
     * ==========================================
     * Scopes
     */
    
    /**
     * ======================================
     * Accessors
     */
    public function getDepartmentsListAttribute()
    {
        return Department::lists('department', 'id');
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
