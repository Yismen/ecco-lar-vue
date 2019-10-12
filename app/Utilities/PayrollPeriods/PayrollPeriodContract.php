<?php

namespace App\Utilities\PayrollPeriods;

use Carbon\Carbon;

abstract class PayrollPeriodContract
{
    /**
     * Date passed in
     */
    protected $date;

    /**
     * Period starting date
     *
     * @var Carbon;
     */
    public $start;

    /**
     * Period ending date
     *
     * @var Carbon
     */
    public $end;

    /**
     * The name representative of the period returned
     *
     * @var String
     */
    public $period;

    /**
     * Constructor  
     *
     * @param Carbon $date
     */
    public function __construct(Carbon $date)
    {
        $this->date = $date;

        $this->start = $this->setDateFrom();

        $this->end = $this->setDateTo();

        $this->period = $this->setPeriod();
    }

    /**
     * Date from property setter
     *
     * @return Carbon
     */
    abstract protected function setDateFrom();

    /**
     * Date to property setter
     *
     * @return Carbon
     */
    abstract protected function setDateTo();

    /**
     * Period property setter
     *
     * @return void
     */
    abstract protected function setPeriod();
}
