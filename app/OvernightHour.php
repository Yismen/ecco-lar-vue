<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OvernightHour extends Model
{
    /**
     * Convert fields to Carbon Intances
     */
    protected $dates = ['date'];

    protected $fillable = ['date', 'employee_id', 'hours'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * During import remove any data previously captured
     *
     * @param date text $date
     * @param integer $employee_id
     * @return void
     */
    public function removeDuplicated($date, $employee_id)
    {
        $duplicateds = $this->whereDate('date', $date)
            ->where('employee_id', $employee_id)
            ->get();

        foreach ($duplicateds as $duplicated) {
            $duplicated->delete();
        }
    }
}
