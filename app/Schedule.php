<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Schedule extends Model
{
    use Sluggable;

    protected $table = 'schedules';

    protected $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    protected $fillable = ['employee_id', 'day', 'hours'];

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
                'unique' => false,
            ],
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getEmployeesListAttribute()
    {
        return Employee::actives()
            ->orderBy('first_name')
            ->orderBy('second_first_name')
            ->orderBy('last_name')
            ->orderBy('second_last_name')
            ->get();
    }

    public function createNew($fields)
    {
        foreach ($fields['days'] as $day) {
            if (in_array($day, $this->days)) {
                $this->removeIfExists($fields['employee_id'], $day);
                $this->create(
                    [
                        'employee_id' => $fields['employee_id'],
                        'day' => $day,
                        'hours' => $fields['hours'],
                    ]
                );
            }
        }
    }

    public function createFor($employee_id, $day, $hours)
    {
        $this->removeIfExists($employee_id, $day);

        $this->create(
            [
                'employee_id' => $employee_id,
                'day' => $day,
                'hours' => $hours,
            ]
        );
    }

    private function removeIfExists($employee, $day)
    {
        $model = $this->exists($employee, $day);

        if ($model) {
            $model->delete();
        }
    }

    private function exists($employee, $day)
    {
        return $this->where('employee_id', $employee)->where('day', $day)->first();
    }
}
