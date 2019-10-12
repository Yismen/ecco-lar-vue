<?php

namespace Tests\Feature\PayrollPeriods;

use App\Utilities\PayrollPeriods\ByWeeklyPayrollPeriod;
use App\Utilities\PayrollPeriods\PayrollPeriodContract;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ByWeeklyParyollPeriodTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_implements_payroll_period_contract()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertInstanceOf(PayrollPeriodContract::class, $periods);
    }

    /** @test */
    public function it_has_date_attribute()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('date', ByWeeklyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_start_attribute()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('start', ByWeeklyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_end_attribute()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('end', ByWeeklyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_period_attribute()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('period', ByWeeklyPayrollPeriod::class);
    }

    /** @test */
    public function start_equals_start_of_month_if_day_is_15_or_less()
    {
        $date = Carbon::parse('2019-09-01');

        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertEquals($periods->start, $date);
    }

    /** @test */
    public function start_equals_the_16th_of_month_if_day_is_greater_than_16()
    {
        $date = Carbon::parse('2019-09-16');

        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-24'));

        $this->assertEquals($periods->start, $date);
    }

    /** @test */
    public function end_equals_the_15th_of_month_if_day_is_less_than_16()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-10'));

        $this->assertEquals($periods->end, Carbon::parse('2019-09-15'));
    }

    /** @test */
    public function end_equals_end_of_month_if_day_is_equal_or_greater_than_16()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-20'));

        $this->assertEquals($periods->end, Carbon::parse('2019-09-30')->endOfMonth());
    }

    /** @test */
    public function period_equals_first_period_of_month()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-01'));

        $this->assertEquals($periods->period, "P_20190901_20190915");
    }

    /** @test */
    public function period_equals_second_period_of_month()
    {
        $periods = new ByWeeklyPayrollPeriod(Carbon::parse('2019-09-18'));

        $this->assertEquals($periods->period, "P_20190916_20190930");
    }
}
