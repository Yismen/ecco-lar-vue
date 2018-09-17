<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name'];

    
    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
    
    public function sources()
    {
        return $this->belongsToMany(Source::class);
    }
    
    public function productions()
    {
        return $this->hasMany('App\Production');
    }

    public function getDepartmentsListAttribute()
    {
        return Department::select('department', 'id')->get();
    }

    public function getSourcesListAttribute()
    {
        return Source::select('name', 'id')->get();
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtoupper(trim($name));
    }
}
