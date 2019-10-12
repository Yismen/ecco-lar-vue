<?php

namespace Tests\Feature\PayrollPeriods;

use App\Utilities\PayrollPeriods\MonthlyPayrollPeriod;
use App\Utilities\PayrollPeriods\PayrollPeriodContract;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class MonthlyPayrollPeriodTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_implements_payroll_period_contract()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertInstanceOf(PayrollPeriodContract::class, $periods);
    }

    /** @test */
    public function it_has_date_attribute()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('date', MonthlyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_start_attribute()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('start', MonthlyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_end_attribute()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('end', MonthlyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_period_attribute()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('period', MonthlyPayrollPeriod::class);
    }

    /** @test */
    public function start_equals_start_of_month()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertEquals($periods->start, Carbon::parse('2019-09-05')->startOfMonth());
    }

    /** @test */
    public function end_equals_last_day_of_month()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-10'));

        $this->assertEquals($periods->end, Carbon::parse('2019-09-10')->endOfMonth());
    }

    /** @test */
    public function period_equals_first_period_of_week()
    {
        $periods = new MonthlyPayrollPeriod(Carbon::parse('2019-09-02'));

        $this->assertEquals($periods->period, "P_20190901_20190930");
    }
}
