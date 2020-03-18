<?php

namespace App\Console\Commands\Capillus;

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
            'calls_offered' => $results['Calls Offered'] ?? 0,
            'calls_rerouted' => $results['Calls Re-Routed'] ?? 0,
            'calls_accepted' => $results['Calls Accepted'] ?? 0,
            'calls_answered' => $results['Calls Answered'] ?? 0,
            'short_abandons' => $results['Short Abandons'] ?? 0,
            'long_abandons' => $results['Long Abandons'] ?? 0,
            'cap_ultra' => $results['Cap Ultra'] ?? 0,
            'date' => $results['Current Date'],
            'cap_plus' => $results['Cap Plus'] ?? 0,
            'cap_pro' => $results['Cap Pro'] ?? 0,
            'total_revenue' => $results['Total Revenue'] ?? 0,
            'inbound_minutes' => $results['Inbound Minutes'] ?? 0,
            'outbound_minutes' => $results['Outbound Minutes'] ?? 0,
            'call_back' => $results['Call Back'] ?? 0,
            'caller_hung_up_after_pitch' => $results['Caller Hung Up After Pitch'] ?? 0,
            'doesn_t_have_a_credit_debit_card_paypal' => $results['Doesn t Have a Credit   Debit Card   PayPal'] ?? 0,
            'doesn_t_want_to_pay_with_credit_debit_card' => $results['Doesn t Want to Pay With Credit   Debit Card'] ?? 0,
            'insufficient_funds' => $results['Insufficient Funds'] ?? 0,
            'just_wants_information' => $results['Just Wants Information'] ?? 0,
            'misunderstood_offer' => $results['Misunderstood Offer'] ?? 0,
            'needs_to_speak_with_spouse' => $results['Needs to Speak With Spouse'] ?? 0,
            'not_interested' => $results['Not Interested'] ?? 0,
            'sent_to_web_for_financing_no_sale_secured' => $results['Sent to Web for Financing - No Sale Secured'] ?? 0,
            'too_expensive' => $results['Too Expensive'] ?? 0,
            'will_think_about_it' => $results['Will Think About It'] ?? 0,
            'already_a_customer' => $results['Already a Customer'] ?? 0,
            'caller_hung_up_less_than_20_sec' => $results['Caller Hung Up (Less than 20 Sec)'] ?? 0,
            'customer_care_after_hours' => $results['Customer Care (After Hours)'] ?? 0,
            'dead_air' => $results['Dead Air'] ?? 0,
            'do_not_call' => $results['Do Not Call'] ?? 0,
            'fax_machine_telephone_problem' => $results['Fax Machine   Telephone Problem'] ?? 0,
            'language_barrier' => $results['Language Barrier'] ?? 0,
            'other_catchall' => $results['Other (Catch-All)'] ?? 0,
            'prank_call' => $results['Prank Call'] ?? 0,
            'test_call' => $results['Test Call'] ?? 0,
            'transfer_customer_service_question_issue' => $results['Transfer (Customer Service Question Issue)'] ?? 0,
            'transfer_bulk_order' => $results['Transfer (Bulk Order)'] ?? 0,
            'transfer_physician_doctor' => $results['Transfer (Physician   Doctor)'] ?? 0,
            'wrong_number' => $results['Wrong Number'] ?? 0,
        ];
    }
}
