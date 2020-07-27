<?php

namespace App\Console\Commands\Because;

use App\Console\Commands\Traits\NotifyUsersOnFailedCommandsTrait;
use Exception;

trait BecauseCommandsTrait
{
    use NotifyUsersOnFailedCommandsTrait;
    
    public function becauseCampaigns()
    {
        $campaigns = config('dainsys.because.campaigns');

        if (! $campaigns) {
            throw new Exception("Because Campaigns not set in config.dainsys.because array!");
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
        $list = config('dainsys.because.distro') ??
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    }

    protected function getArrayFields($results)
    {
        return [
            "date" => $results["ReportDate"] ,
            "campaign" => $results["Campaign"],
            "duration" => $results["Duration"] ?? 0,
            "weekday" => $results["WeekDay"] ?? 0,
            "calls" => $results["Calls"] ?? 0,
            "calls_answered" => $results["Calls Answered"] ?? 0,
            "ivr_disconnects" => $results["IVR Disconnects"] ?? 0,
            "abandon" => $results["Abandon"] ?? 0,
            "already_a_customer" => $results["Already a Customer"] ?? 0,
            "call_back" => $results["Call Back"] ?? 0,
            "caller_hung_up_before_branding" => $results["Caller Hung Up Before Branding"] ?? 0,
            "caller_hung_up_during_pitch" => $results["Caller Hung Up During Pitch"] ?? 0,
            "cancel_order" => $results["Cancel Order"] ?? 0,
            "customer_care_afterhours" => $results["Customer Care - After-Hours"] ?? 0,
            "customer_care_transferred" => $results["Customer Care - Transferred"] ?? 0,
            "dead_air" => $results["Dead Air"] ?? 0,
            "doesnt_want_to_pay_with_creditdebit_card" => $results["Doesnt want to pay with Credit-Debit Card"] ?? 0,
            "fax_machine_or_telephone_problem" => $results["Fax Machine or Telephone Problem"] ?? 0,
            "insufficient_funds" => $results["Insufficient Funds"] ?? 0,
            "just_wants_information" => $results["Just Wants Information"] ?? 0,
            "language_barrier" => $results["Language Barrier"] ?? 0,
            "misunderstood_offer" => $results["Misunderstood Offer"] ?? 0,
            "needs_to_speak_with_spouse" => $results["Needs to Speak With Spouse"] ?? 0,
            "no_credit_or_debit_card" => $results["No credit or debit card"] ?? 0,
            "no_disposition" => $results["No Disposition"] ?? 0,
            "not_interested" => $results["Not Interested"] ?? 0,
            "objects_to_autorenew" => $results["Objects to Auto-Renew"] ?? 0,
            "prank_call" => $results["Prank Call"] ?? 0,
            "sale" => $results["Sale"] ?? 0,
            "test_call" => $results["Test Call"] ?? 0,
            "too_expensive" => $results["Too Expensive"] ?? 0,
            "transfer_customer_care" => $results["Transfer - Customer Care"] ?? 0,
            "transfer_not_customer_care_issue" => $results["Transfer - Not Customer Care Issue"] ?? 0,
            "wants_product_but_not_subscription" => $results["Wants Product but Not Subscription"] ?? 0,
            "will_think_about_it" => $results["Will Think About It"] ?? 0,
            "wrong_number" => $results["Wrong Number"] ?? 0,
        ];
    }
}
