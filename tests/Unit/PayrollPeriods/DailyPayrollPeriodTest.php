<?php

namespace Tests\Feature\PayrollPeriods;

use App\Utilities\PayrollPeriods\DailyPayrollPeriod;
use App\Utilities\PayrollPeriods\PayrollPeriodContract;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class DailyParyollPeriodTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_implements_payroll_period_contract()
    {
        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertInstanceOf(PayrollPeriodContract::class, $periods);
    }

    /** @test */
    public function it_has_date_attribute()
    {
        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('date', DailyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_start_attribute()
    {
        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('start', DailyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_end_attribute()
    {
        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('end', DailyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_period_attribute()
    {
        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('period', DailyPayrollPeriod::class);
    }

    /** @test */
    public function start_equals_start_of_day()
    {
        $date = Carbon::parse('2019-09-01 00:00');

        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-01 05:45'));

        $this->assertEquals($periods->start, $date);
    }

    /** @test */
    public function end_equals_end_of_day()
    {
        $date = Carbon::parse('2019-09-01')->endOfDay();

        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-01 05:45'));

        $this->assertEquals($periods->end, $date);
    }

    /** @test */
    public function period_equals_same_day()
    {
        $periods = new DailyPayrollPeriod(Carbon::parse('2019-09-01'));

        $this->assertEquals($periods->period, "P_20190901_20190901");
    }
}
