<?php

namespace App;

use Carbon\Carbon;
use App\Traits\Trackable;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Mutators\EmployeeMutators;
use App\Http\Traits\Accessors\EmployeeAccessors;
use App\Http\Traits\Relationships\EmployeeRelationships;

class Employee extends Model
{
    use EmployeeRelationships, EmployeeAccessors, EmployeeMutators, Trackable;

    protected $fillable = [
        'first_name',
        'second_first_name',
        'last_name',
        'second_last_name',
        'hire_date',
        'personal_id',
        'passport',
        'date_of_birth',
        'cellphone_number',
        'secondary_phone',
        'position_id',
        'supervisor_id',
        'gender_id',
        'marital_id',
        'ars_id',
        'afp_id',
        'has_kids',
        'photo',
    ];
    /**
     * Fields to be converted to Carbon instances
     * @var Carbon Instance
     */
    protected $dates = ['hire_date', 'date_of_birth'];

    protected $guarded = [];

    protected $appends = [
        'full_name',
        'active',
        'status',
        'nationality',
    ];

    public function scopeActives($query)
    {
        return $query->has('termination', false);
    }

    public function scopeHiredSince($query, $date)
    {
        $date = Carbon::parse($date);

        return $query->where('hire_date', '<=', $date);
    }

    public function scopeActiveSince($query, $date)
    {
        $date = Carbon::parse($date);

        return $query->where('hire_date', '<=', $date)
            ->where(function ($query) {
                $query->has('termination', false);
            });
    }

    /**
     * Determine if an employee was active on a given date.
     * @param  [query] $query DB query builder chaining
     * @param  [string as date] $date  A date like string to parsed with Carbon
     * @return [query]        returns the query builder chaining.
     */
    public function scopeWasActiveOrTerminatedBefore($query, $date)
    {
        $date = Carbon::parse($date);

        return $query->where('hire_date', '<=', $date)
            ->where(function ($query) use ($date) {
                $query->has('termination', false)
                    ->orWhereHas('termination', function ($query) use ($date) {
                        $query->where('termination_date', '>=', $date);
                    });
            });
    }

    public function scopeInactives($query)
    {
        return $query->has('termination');
    }

    public function scopeMissingCard($query)
    {
        return $query->has('card', false);
    }

    public function computedSalary()
    {
        $base_salary = 8310;
        if ($this->position && $this->position->salary) {
            // if ($this->position->payment->payment_type == 'By-Weekly') {
            // 	return $this->position->salary * 2;
            // };

            // if ($this->position->payment->payment_type == 'Monthly') {
            // 	return $this->position->salary;
            // };
            if ($this->position->salary > $base_salary) {
                return $this->position->salary;
            };
        }
        return $base_salary;
    }

    public function vacationsStarts()
    {
        return $this->hire_date->addYears(1);
    }

    public function vacationsEnds()
    {
        $starts = $this->vacationsStarts();
        $days = $starts->diffInYears(Carbon::today()) >= 5 ? 21 : 14;
        return $starts->addDays($days);
    }

    public function activesOn($date)
    {
        $date = Carbon::parse($date)->format('Y-m-d');

        return $this->where('hire_date', '<=', $date)
            ->with(['termination' => function ($query) {
                return $query->where('termination_date', '>=', $date);
            }])
            ->get();
    }

    public function activesOnYear($year)
    {
        return $this->whereYear('hire_date', '<=', $year)->with(['termination' => function ($query) {
            return $query->where('termination_date', '>=', '2012-02-09');
        }])->get();
    }

    public function inactivate(Carbon $carbon)
    {
        ///// under construction
        return $this->termination()->save([
            'termination_date' => $carbon->now(),
            'termination_type_id' => $carbon->now(),
            'termination_reason_id' => $carbon->now(),
            'can_be_rehired' => $carbon->now(),
            ]);
    }

    /**
     * cheks if the current employeed
     * @return string or null 'Masculine'
     */
    public function isMasculine()
    {
        return $this->has('gender') && $this->gender->gender == 'Masculine' ? 'Masculine' : null;
    }

    public function isFemenine()
    {
        return $this->has('gender') && $this->gender->gender == 'Femenine' ? 'Femenine' : null;
    }

    public function isOfGender($gender, $return_value = null)
    {
        if ($this->has('gender') && strtolower($this->gender->gender) == strtolower($gender)) {
            if ($return_value) {
                return $return_value;
            }
            return $gender;
        }

        return null;
    }
}
