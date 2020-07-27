<?php

namespace App;

use Carbon\Carbon;
use App\DainsysModel as Model;

class BecauseDailyPerformance extends Model
{
    protected $fillable = [
        "date",
        "weekday",
        "campaign",
        "duration",
        "calls",
        "calls_answered",
        "ivr_disconnects",
        "abandon",
        "already_a_customer",
        "call_back",
        "caller_hung_up_before_branding",
        "caller_hung_up_during_pitch",
        "cancel_order",
        "customer_care_afterhours",
        "customer_care_transferred",
        "dead_air",
        "doesnt_want_to_pay_with_creditdebit_card",
        "fax_machine_or_telephone_problem",
        "insufficient_funds",
        "just_wants_information",
        "language_barrier",
        "misunderstood_offer",
        "needs_to_speak_with_spouse",
        "no_credit_or_debit_card",
        "no_disposition",
        "not_interested",
        "objects_to_autorenew",
        "prank_call",
        "sale",
        "test_call",
        "too_expensive",
        "transfer_customer_care",
        "transfer_not_customer_care_issue",
        "wants_product_but_not_subscription",
        "will_think_about_it",
        "wrong_number",
    ];

    protected $dates = ['date'];
    
    public function removeIfExists(array $options = [])
    {
        $options = array_merge([
            'date' => Carbon::parse()->format('Y-m-d'),
            'campaign' => 'LA Times'
        ], $options);

        $this
            ->whereDate('date', $options['date'])
            ->where('campaign', $options['campaign'])
            ->delete();

        return $this;
    }

    public function scopeWtd($query, Carbon $date)
    {
        return $query->whereBetween('date', [
            Carbon::parse($date)->startOfWeek()->format('Y-m-d'),
            Carbon::parse($date)->endOfWeek()->format('Y-m-d')
        ]);
    }

    public function scopeMtd($query, Carbon $date)
    {
        return $query->whereBetween('date', [
            Carbon::parse($date)->startOfMonth()->format('Y-m-d'),
            Carbon::parse($date)->format('Y-m-d')
        ]);
    }

    public function scopePtd($query, Carbon $date)
    {
        return $query->where('date', '<=', $date);
    }
}
