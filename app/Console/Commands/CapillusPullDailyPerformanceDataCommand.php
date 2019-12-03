<?php

namespace App\Console\Commands;

use App\CapillusDailyPerformance;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\Capillus\CapillusDailyLogTimeMail;
use App\Exports\Capillus\CapillusAgentLogTimeExport;
use App\Repositories\Capillus\CapillusPullDailyPerformanceDataRepository;
use Illuminate\Support\Facades\Mail;

class CapillusPullDailyPerformanceDataCommand extends Command
{
    use CapillusCommandsTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dainsys:capillus-pull-daily-permance-data {--date=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capillus - pull daily performance data';

    protected $repo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->repo = new CapillusPullDailyPerformanceDataRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            
            // Gather the data from the DB
            $campaign = 'Capillus DRTV';
            $date = $this->option('date') == 'default' ? 
                Carbon::now()->subDay() : 
                Carbon::parse($this->option('date'));

            $results = collect(
                $this->repo->getData($campaign, $date->format('Y-m-d H:i:s'))[0]
            )->toArray();

            // Save the data to my table
            (new CapillusDailyPerformance)
                ->removeIfExists($results['Current Date'])
                ->create($this->getArrayFields($results));

        } catch (\Throwable $th) {
            Log::error($th);
        }        
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
            'transfer_physician_doctor' => $results['Transfer (Physician   Doctor)'],
            'wrong_number' => $results['Wrong Number'],
        ];
    }
}
