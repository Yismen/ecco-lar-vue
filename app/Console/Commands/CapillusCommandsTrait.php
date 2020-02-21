<?php

namespace App\Console\Commands;

use Exception;

trait CapillusCommandsTrait
{
    public function capillusCampaigns()
    {
        $campaigns = config('dainsys.capillus.campaigns');

        if (! $campaigns) {
            throw new Exception("Capillus Campaigns not set in config.dainsys.capillus array!");
        }

        return explode('|', $campaigns);
    }
    /**
     * Parse the distro list from the dainsys config file
     *
     * @return array
     */
    protected function distroList(): array
    {
        $list = config('dainsys.capillus.distro') ??
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    }

    protected function getArrayFields($results)
    {
        return [
            'campaign' => $results['Campaign'],
            'calls_offered' => $results['Calls Offered'],
            'calls_rerouted' => $results['Calls Re-Routed'],
            'calls_accepted' => $results['Calls Accepted'],
            'calls_answered' => $results['Calls Answered'],
            'short_abandons' => $results['Short Abandons'],
            'long_abandons' => $results['Long Abandons'],
            'cap_ultra' => $results['Cap Ultra'],
            'date' => $results['Current Date'],
            'cap_plus' => $results['Cap Plus'],
            'cap_pro' => $results['Cap Pro'],
            'total_revenue' => $results['Total Revenue'],
            'inbound_minutes' => $results['Inbound Minutes'],
            'outbound_minutes' => $results['Outbound Minutes'],
            'call_back' => $results['Call Back'],
            'caller_hung_up_after_pitch' => $results['Caller Hung Up After Pitch'],
            'doesn_t_have_a_credit_debit_card_paypal' => $results['Doesn t Have a Credit   Debit Card   PayPal'],
            'doesn_t_want_to_pay_with_credit_debit_card' => $results['Doesn t Want to Pay With Credit   Debit Card'],
            'insufficient_funds' => $results['Insufficient Funds'],
            'just_wants_information' => $results['Just Wants Information'],
            'misunderstood_offer' => $results['Misunderstood Offer'],
            'needs_to_speak_with_spouse' => $results['Needs to Speak With Spouse'],
            'not_interested' => $results['Not Interested'],
            'sent_to_web_for_financing_no_sale_secured' => $results['Sent to Web for Financing - No Sale Secured'],
            'too_expensive' => $results['Too Expensive'],
            'will_think_about_it' => $results['Will Think About It'],
            'already_a_customer' => $results['Already a Customer'],
            'caller_hung_up_less_than_20_sec' => $results['Caller Hung Up (Less than 20 Sec)'],
            'customer_care_after_hours' => $results['Customer Care (After Hours)'],
            'dead_air' => $results['Dead Air'],
            'do_not_call' => $results['Do Not Call'],
            'fax_machine_telephone_problem' => $results['Fax Machine   Telephone Problem'],
            'language_barrier' => $results['Language Barrier'],
            'other_catchall' => $results['Other (Catch-All)'],
            'prank_call' => $results['Prank Call'],
            'test_call' => $results['Test Call'],
            'transfer_customer_service_question_issue' => $results['Transfer (Customer Service Question Issue)'],
            'transfer_bulk_order' => $results['Transfer (Bulk Order)'],
            'transfer_physician_doctor' => $results['Transfer (Physician   Doctor)'],
            'wrong_number' => $results['Wrong Number'],
        ];
    }
}
