<?php

namespace App\Utilities\PayrollPeriods;

use Carbon\Carbon;

class ByWeeklyPayrollPeriod extends PayrollPeriodContract
{

    /**
     * Date from property setter
     *
     * @return Carbon
     */
    protected function setDateFrom()
    {
        return $this->date->day <= 15 ?
            Carbon::parse($this->date)->startOfMonth() : Carbon::create(
                $this->date->year,
                $this->date->month,
                16,
                0,
                0,
                0
            );
    }

    /**
     * Date to property setter
     *
     * @return Carbon
     */
    protected function setDateTo()
    {
        return $this->date->day > 15 ?
            Carbon::parse($this->date)->endOfMonth() : Carbon::create(
                $this->date->year,
                $this->date->month,
                15,
                0,
                0,
                0
            );
    }

    /**
     * Period property setter
     *
     * @return void
     */
    protected function setPeriod()
    {
        return  "P_" .
            $this->start->format("Ymd") .
            "_" .
            $this->end->format("Ymd");
    }
}
