<?php

namespace App;

use Carbon\Carbon;
use App\DainsysModel as Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Shift extends Model
{
    use Sluggable;

    protected $fillable = ['employee_id', 'start_at', 'end_at', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getStartAtAttribute($start_at)
    {
        return Carbon::parse($start_at)->format('H:i');
    }

    public function getEndAtAttribute($start_at)
    {
        return Carbon::parse($start_at)->format('H:i');
    }

    public function getEmployeesListAttribute()
    {
        return Employee::actives()
            ->orderBy('first_name')
            ->orderBy('second_first_name')
            ->orderBy('last_name')
            ->get();
    }
}
