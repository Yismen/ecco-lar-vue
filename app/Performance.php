<?php

namespace App;

use App\Traits\Trackable;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use Trackable;

    protected $fillable = ['unique_id', 'date', 'employee_id', 'name', 'campaign_id', 'supervisor_id', 'sph_goal', 'login_time', 'production_time', 'talk_time', 'billable_hours', 'contacts', 'calls', 'transactions', 'upsales', 'cc_sales', 'revenue', 'downtime_reason_id', 'reported_by', 'file_name'];

    public static function removeExisting($unique_id)
    {
        $instance = new self();

        $instance->whereUniqueId($unique_id)
            ->delete();

        return $instance;
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function downtimeReason()
    {
        return $this->belongsTo(DowntimeReason::class);
    }

    public function getEmployeesListAttribute()
    {
        return Employee::orderBy('first_name')->orderBy('second_first_name')->get();
    }

    public function getDowntimesCampaignsListAttribute()
    {
        return Campaign::orderBy('name')->where('name', 'like', '%downtimes%')->get();
    }

    public function getDowntimesReasonsListAttribute()
    {
        return DowntimeReason::orderBy('name')->get();
    }

    public function getSupervisorsListAttribute()
    {
        return Supervisor::orderBy('name')->get();
    }

    public function getActiveSupervisorsListAttribute()
    {
        return Supervisor::orderBy('name')->actives()->get();
    }

    public function createManually(Request $request)
    {
        $employee = Employee::with('supervisor')->findOrFail($request->employee_id);

        $fields = [
            'unique_id' => $request->date.'-'.$request->employee_id.'-'.$request->campaign_id,
            'date' => $request->date,
            'employee_id' => $request->employee_id,
            'name' => $employee->fullName,
            'campaign_id' => $request->campaign_id,
            'supervisor_id' => optional($employee->supervisor)->id,
            'login_time' => $request->login_time,
            'downtime_reason_id' => $request->downtime_reason_id,
            'reported_by' => $request->reported_by,
        ];

        return $this->create($fields);
    }
}
