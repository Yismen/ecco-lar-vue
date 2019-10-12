<?php

namespace Tests\Feature\PayrollPeriods;

use App\Utilities\PayrollPeriods\YearlyPayrollPeriod;
use App\Utilities\PayrollPeriods\PayrollPeriodContract;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class YearlyPayrollPeriodTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_implements_payroll_period_contract()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertInstanceOf(PayrollPeriodContract::class, $periods);
    }

    /** @test */
    public function it_has_date_attribute()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('date', YearlyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_start_attribute()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('start', YearlyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_end_attribute()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('end', YearlyPayrollPeriod::class);
    }

    /** @test */
    public function it_has_period_attribute()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertClassHasAttribute('period', YearlyPayrollPeriod::class);
    }

    /** @test */
    public function start_equals_start_of_year()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-05'));

        $this->assertEquals($periods->start, Carbon::parse('2019-09-05')->startOfYear());
    }

    /** @test */
    public function end_equals_last_day_of_year()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-10'));

        $this->assertEquals($periods->end, Carbon::parse('2019-09-10')->endOfYear());
    }

    /** @test */
    public function period_equals_first_period_of_year()
    {
        $periods = new YearlyPayrollPeriod(Carbon::parse('2019-09-02'));

        $this->assertEquals($periods->period, "P_20190101_20191231");
    }
}
