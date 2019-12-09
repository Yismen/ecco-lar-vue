<?php

namespace App\Repositories\Capillus;

use App\CapillusDailyPerformance;
use Carbon\Carbon;

class CapillusPerformanceReportRepository
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
    }

    protected function baseQuery()
    {
        return CapillusDailyPerformance::selectRaw($this->rawString())
            ->where('campaign', 'like', "{$this->campaign}%");
    }

    protected function wtd() 
    {     
        return CapillusDailyPerformance::select('date')
        ->selectRaw($this->rawString())
        ->orderBy('date')
        ->groupBy('date')
        ->wtd($this->date)
        ->where('campaign', 'like', "{$this->campaign}%")
        ->get();
    }

    protected function mtd() 
    {
        return CapillusDailyPerformance::selectRaw($this->rawString())
            ->where('campaign', 'like', "{$this->campaign}%")
            ->mtd($this->date)                
            ->get();
    }

    protected function ptd() 
    {
        return CapillusDailyPerformance::selectRaw($this->rawString())
            ->where('campaign', 'like', "{$this->campaign}%")
            ->ptd($this->date)                
            ->get();
    }

    protected function rawString() 
    {
        return '
            sum(calls_offered) as calls_offered, 
            sum(calls_rerouted) as calls_rerouted, 
            sum(calls_accepted) as calls_accepted, 
            sum(calls_answered) as calls_answered, 
            sum(short_abandons) as short_abandons, 
            sum(long_abandons) as long_abandons, 
            sum(cap_ultra) as cap_ultra, 
            sum(cap_plus) as cap_plus, 
            sum(cap_pro) as cap_pro, 
            sum(total_revenue) as total_revenue, 
            sum(inbound_minutes) as inbound_minutes, 
            sum(call_back) as call_back, 
            sum(caller_hung_up_after_pitch) as caller_hung_up_after_pitch, 
            sum(doesn_t_have_a_credit_debit_card_paypal) as doesn_t_have_a_credit_debit_card_paypal, 
            sum(doesn_t_want_to_pay_with_credit_debit_card) as doesn_t_want_to_pay_with_credit_debit_card, 
            sum(insufficient_funds) as insufficient_funds, 
            sum(just_wants_information) as just_wants_information, 
            sum(misunderstood_offer) as misunderstood_offer, 
            sum(needs_to_speak_with_spouse) as needs_to_speak_with_spouse, 
            sum(not_interested) as not_interested, 
            sum(sent_to_web_for_financing_no_sale_secured) as sent_to_web_for_financing_no_sale_secured, 
            sum(too_expensive) as too_expensive, 
            sum(will_think_about_it) as will_think_about_it, 
            sum(already_a_customer) as already_a_customer, 
            sum(caller_hung_up_less_than_20_sec) as caller_hung_up_less_than_20_sec, 
            sum(customer_care_after_hours) as customer_care_after_hours, 
            sum(dead_air) as dead_air, 
            sum(do_not_call) as do_not_call, 
            sum(fax_machine_telephone_problem) as fax_machine_telephone_problem, 
            sum(language_barrier) as language_barrier, 
            sum(other_catchall) as other_catchall, 
            sum(prank_call) as prank_call, 
            sum(test_call) as test_call, 
            sum(transfer_customer_service_question_issue) as transfer_customer_service_question_issue, 
            sum(transfer_physician_doctor) as transfer_physician_doctor, 
            sum(transfer_bulk_order) as transfer_bulk_order, 
            sum(wrong_number) as wrong_number        
        ';
    }
}