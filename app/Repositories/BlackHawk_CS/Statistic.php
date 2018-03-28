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

    public function qaDates()
    {
        return BlackhawkQascore::select('date')->groupBy('date')->latest('date')->take(10)->get();
    }

    public function qaErrorDates()
    {
        return BlackhawkQaErrors::select('date')->groupBy('date')->latest('date')->take(10)->get();
    }

    public function lobDates()
    {
        return BlackhawkLobSummary::select('date')->groupBy('date')->latest('date')->take(10)->get();
    }

    public function performanceDates()
    {
        return BlackhawkPerformanceSummary::select('date')->groupBy('date')->latest('date')->take(10)->get();
    }
}
