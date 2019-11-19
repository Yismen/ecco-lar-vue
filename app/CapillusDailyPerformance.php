<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CapillusDailyPerformance extends Model
{
    protected $fillable = [
        'calls_offered',
        'calls_answered',
        'short_abandons',
        'long_abandons',
        'cap_ultra',
        'date',
        'cap_plus',
        'cap_pro',
        'total_revenue',
        'inbound_minutes',
        'call_back',
        'caller_hung_up_after_pitch',
        'doesn_t_have_a_credit_debit_card_paypal',
        'doesn_t_want_to_pay_with_credit_debit_card',
        'insufficient_funds',
        'just_wants_information',
        'misunderstood_offer',
        'needs_to_speak_with_spouse',
        'not_interested',
        'sent_to_web_for_financing_no_sale_secured',
        'too_expensive',
        'will_think_about_it',
        'already_a_customer',
        'caller_hung_up_less_than_20_sec',
        'customer_care_after_hours',
        'dead_air',
        'do_not_call',
        'fax_machine_telephone_problem',
        'language_barrier',
        'other_catchall',
        'prank_call',
        'test_call',
        'transfer_customer_service_question_issue',
        'transfer_physician_doctor',
        'wrong_number',
    ];

    protected $dates = ['date'];
    
    public function removeIfExists($date)
    {
        $this->whereDate('date', $date)->delete();

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
