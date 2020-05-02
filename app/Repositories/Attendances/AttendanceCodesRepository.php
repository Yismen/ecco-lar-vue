<?php

namespace App\Repositories\Attendances;

use App\Attendance;
use App\AttendanceCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AttendanceCodesRepository
{
    protected $current_user;

    protected $code;

    public function __construct(int $code, bool $current_user = true)
    {
        $this->current_user = $current_user == true ? auth()->user()->id : '%';

        $this->code = $code;
    }


    public function data()
    {
        return Cache::remember('attendances-' . $this->code . '-' . $this->current_user, now()->addHours(4), function () {
            return [
                'this_week' => $this->thisWeek(),
                'last_week' => $this->lastWeek(),
                'this_month' => $this->monthToDate(),
                'last_month' => $this->previousMonth(),
                'two_months_ago' => $this->twoMonthsAgo(),
                'year_to_date' => $this->yearToDate(),
            ];
        });
    }

    public function codes()
    {
        return AttendanceCode::get();
    }

    protected function thisWeek()
    {
        return $this->prepare()->whereDate('date', '>=', Carbon::now()->startOfWeek())->get();
    }

    protected function lastWeek()
    {
        return $this->prepare()
            ->whereDate('date', '>=', Carbon::now()->subWeek()->startOfWeek())
            ->whereDate('date', '<=', Carbon::now()->subWeek()->endOfweek())
            ->get();
    }

    protected function monthToDate()
    {
        return $this->prepare()->whereMonth('date', Carbon::now()->month)->get();
    }

    protected function previousMonth()
    {
        return $this->prepare()->whereMonth('date', Carbon::now()->subMonth())->get();
    }

    protected function twoMonthsAgo()
    {
        return $this->prepare()->whereMonth('date', Carbon::now()->subMonths(2))->get();
    }

    protected function yearToDate()
    {
        return $this->prepare()->whereYear('date', Carbon::now()->year)->get();
    }
    protected function prepare()
    {
        return Attendance::where('code_id', $this->code)
            ->with('employee')
            ->where('user_id', 'like', $this->current_user)
            ->where('code_id', $this->code);
    }
}
