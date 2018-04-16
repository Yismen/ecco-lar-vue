<?php

namespace App\Repositories\BlackHawk_CS;

use App\BlackhawkQascore;
use App\BlackhawkQaErrors;
use App\BlackhawkLobSummary;
use App\BlackhawkPerformanceSummary;

class Statistic
{
    public $qa_dates;
    public $qa_error_dates;
    public $lob_dates;
    public $performance_dates;

    public function __construct()
    {
        $this->qa_dates = $this->qaDates();
        $this->qa_error_dates = $this->qaErrorDates();
        $this->lob_dates = $this->lobDates();
        $this->performance_dates = $this->performanceDates();
    }

    private function query($model)
    {
        return $model->selectRaw('date, count(date) as count')
            ->groupBy('date')
            ->latest('date')
            ->paginate(10);
    }

    public function qaDates()
    {
        return $this->query(new BlackhawkQascore());
    }

    public function qaErrorDates()
    {
        return $this->query(new BlackhawkQaErrors());
    }

    public function lobDates()
    {
        return $this->query(new BlackhawkLobSummary());
    }

    public function performanceDates()
    {
        return $this->query(new BlackhawkPerformanceSummary());
    }
}
