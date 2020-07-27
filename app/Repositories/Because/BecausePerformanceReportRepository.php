<?php

namespace App\Repositories\Because;

use App\BecauseDailyPerformance;
use Carbon\Carbon;

class BecausePerformanceReportRepository
{
    public $data;

    protected $date;

    protected $campaign;

    public function __construct(array $options)
    {
        $this->date = $options['date'];
        $this->campaign = $options['campaign'];
        
        $this->data = [
            'wtd' => $this->wtd(),
            'mtd' => $this->mtd(),
            'ptd' => $this->ptd(),
        ];

        // dd($this->data);
    }

    protected function baseQuery()
    {
        return BecauseDailyPerformance::selectRaw($this->rawString())
            ->where('campaign', 'like', "{$this->campaign}");
    }

    protected function wtd()
    {
        return BecauseDailyPerformance::select('date')
        ->selectRaw($this->rawString())
        ->orderBy('date')
        ->groupBy('date')
        ->wtd($this->date)
        ->where('campaign', 'like', "{$this->campaign}")
        ->get();
    }

    protected function mtd()
    {
        return BecauseDailyPerformance::selectRaw($this->rawString())
            ->where('campaign', 'like', "{$this->campaign}")
            ->mtd($this->date)
            ->get();
    }

    protected function ptd()
    {
        return BecauseDailyPerformance::selectRaw($this->rawString())
            ->where('campaign', 'like', "{$this->campaign}")
            ->ptd($this->date)
            ->get();
    }

    protected function rawString()
    {
        return '
            duration,
            calls,
            calls_answered,
            ivr_disconnects,
            abandon,
            already_a_customer,
            call_back,
            caller_hung_up_before_branding,
            caller_hung_up_during_pitch,
            cancel_order,
            customer_care_afterhours,
            customer_care_transferred,
            dead_air,
            doesnt_want_to_pay_with_creditdebit_card,
            fax_machine_or_telephone_problem,
            insufficient_funds,
            just_wants_information,
            language_barrier,
            misunderstood_offer,
            needs_to_speak_with_spouse,
            no_credit_or_debit_card,
            no_disposition,
            not_interested,
            objects_to_autorenew,
            prank_call,
            sale,
            test_call,
            too_expensive,
            transfer_customer_care,
            transfer_not_customer_care_issue,
            wants_product_but_not_subscription,
            will_think_about_it,
            wrong_number          
        ';
    }
}
