<table>
    <thead>
        <tr><th colspan="11">Kipany-Capillus Overflow Stats - Overall</th></tr>
    </thead>
    <tbody>
        <tr>
            <th></th>
            @foreach ($data['wtd'] as $date)
                <th>{{ $date->date->format('m/d') }}</th>
            @endforeach
            
            @for ($i = count($data['wtd']); $i < 7; $i++)
                <th></th>
            @endfor
            <th>WTD</th>
            <th>MTD</th>
            <th>PTD</th>
        </tr>

        <tr>
            <td>Calls Offered</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_offered }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_offered') }}</td>  
            <td>{{ $data['mtd']->sum('calls_offered') }}</td>  
            <td>{{ $data['ptd']->sum('calls_offered') }}</td>
        </tr>

        <tr>
            <td>Calls Re-routed</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_rerouted }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_rerouted') }}</td>  
            <td>{{ $data['mtd']->sum('calls_rerouted') }}</td>  
            <td>{{ $data['ptd']->sum('calls_rerouted') }}</td>
        </tr>

        <tr>
            <td>Calls Accepted</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_accepted }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_accepted') }}</td>  
            <td>{{ $data['mtd']->sum('calls_accepted') }}</td>  
            <td>{{ $data['ptd']->sum('calls_accepted') }}</td>
        </tr>

        <tr>
            <td>Calls Answered</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_answered }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_answered') }}</td>  
            <td>{{ $data['mtd']->sum('calls_answered') }}</td>  
            <td>{{ $data['ptd']->sum('calls_answered') }}</td>
        </tr> 

        <tr>
            <td>Short Abandon</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->short_abandons }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('short_abandons') }}</td>  
            <td>{{ $data['mtd']->sum('short_abandons') }}</td>  
            <td>{{ $data['ptd']->sum('short_abandons') }}</td>
        </tr> 

        <tr>
            <td>Short Abandon Rate</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Long Abandon</td>
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->long_abandons }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('long_abandons') }}</td>  
            <td>{{ $data['mtd']->sum('long_abandons') }}</td>  
            <td>{{ $data['ptd']->sum('long_abandons') }}</td>
        </tr> 

        <tr>
            <td>Long Abandon Rate</td>
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr>

        <tr>
            <td>% of Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr>

        <tr>
            <td>% of Non-Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Total Overall Minutes</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->inbound_minutes }}</td>
                {{-- there is no outbound minutes --}}
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('inbound_minutes') }}</td> 
            {{-- there is no outbound minutes  --}}
            <td>{{ $data['mtd']->sum('inbound_minutes') }}</td>  
            {{-- there is no outbound minutes --}}
            <td>{{ $data['ptd']->sum('inbound_minutes') }}</td>
        </tr>

        <tr>
            <td>Total Inbound Minutes</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->inbound_minutes }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('inbound_minutes') }}</td>  
            <td>{{ $data['mtd']->sum('inbound_minutes') }}</td>  
            <td>{{ $data['ptd']->sum('inbound_minutes') }}</td>
        </tr> 

        <tr>
            <td>Total Outbound Minutes</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ 0 }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ 0 }}</td>  
            <td>{{ 0 }}</td>  
            <td>{{ 0 }}</td>
        </tr> 

        <tr>
            <td colspan="11">Sales Stats</td>
        </tr> 

        <tr>
            <td>Total Cap Sales</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Cap Ultra</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->cap_ultra }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('cap_ultra') }}</td>  
            <td>{{ $data['mtd']->sum('cap_ultra') }}</td>  
            <td>{{ $data['ptd']->sum('cap_ultra') }}</td>
        </tr> 

        <tr>
            <td>Cap Plus</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->cap_plus }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('cap_plus') }}</td>  
            <td>{{ $data['mtd']->sum('cap_plus') }}</td>  
            <td>{{ $data['ptd']->sum('cap_plus') }}</td>
        </tr> 

        <tr>
            <td>Cap Pro</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->cap_pro }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('cap_pro') }}</td>  
            <td>{{ $data['mtd']->sum('cap_pro') }}</td>  
            <td>{{ $data['ptd']->sum('cap_pro') }}</td>
        </tr> 

        <tr>
            <td>Total Revenue</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->total_revenue }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('total_revenue') }}</td>  
            <td>{{ $data['mtd']->sum('total_revenue') }}</td>  
            <td>{{ $data['ptd']->sum('total_revenue') }}</td>
        </tr> 

        <tr>
            <td>Revenue Per Calls Received</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Revenue Per Call Answered</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Revenue Per Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Conversion - Against Calls Received</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Conversion - Against Calls Answered</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr> 

        <tr>
            <td>Conversion - Against Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr>

        <tr>
            <td colspan="11">Disposition Breakout</td>    
        </tr> 

        <tr>
            <td>Call Backs</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->call_back }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('call_back') }}</td>  
            <td>{{ $data['mtd']->sum('call_back') }}</td>  
            <td>{{ $data['ptd']->sum('call_back') }}</td>
        </tr>

        <tr>
            <td>Caller Hung Up After Pitch</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->caller_hung_up_after_pitch }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('caller_hung_up_after_pitch') }}</td>  
            <td>{{ $data['mtd']->sum('caller_hung_up_after_pitch') }}</td>  
            <td>{{ $data['ptd']->sum('caller_hung_up_after_pitch') }}</td>
        </tr>

        <tr>
            <td>Doesn't Have a Credit / Debit Card / PayPal</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->doesn_t_have_a_credit_debit_card_paypal }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('doesn_t_have_a_credit_debit_card_paypal') }}</td>  
            <td>{{ $data['mtd']->sum('doesn_t_have_a_credit_debit_card_paypal') }}</td>  
            <td>{{ $data['ptd']->sum('doesn_t_have_a_credit_debit_card_paypal') }}</td>
        </tr>

        <tr>
            <td>Doesn't Want to Pay With a Credit / Debit Card</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->doesn_t_want_to_pay_with_credit_debit_card }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('doesn_t_want_to_pay_with_credit_debit_card') }}</td>  
            <td>{{ $data['mtd']->sum('doesn_t_want_to_pay_with_credit_debit_card') }}</td>  
            <td>{{ $data['ptd']->sum('doesn_t_want_to_pay_with_credit_debit_card') }}</td>
        </tr>

        <tr>
            <td>Insufficient Funds</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->insufficient_funds }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('insufficient_funds') }}</td>  
            <td>{{ $data['mtd']->sum('insufficient_funds') }}</td>  
            <td>{{ $data['ptd']->sum('insufficient_funds') }}</td>
        </tr>

        <tr>
            <td>Just Wants Information</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->just_wants_information }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('just_wants_information') }}</td>  
            <td>{{ $data['mtd']->sum('just_wants_information') }}</td>  
            <td>{{ $data['ptd']->sum('just_wants_information') }}</td>
        </tr>

        <tr>
            <td>Misunderstood Offer</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->misunderstood_offer }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('misunderstood_offer') }}</td>  
            <td>{{ $data['mtd']->sum('misunderstood_offer') }}</td>  
            <td>{{ $data['ptd']->sum('misunderstood_offer') }}</td>
        </tr>

        <tr>
            <td>Needs to Speak With Spouse</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->needs_to_speak_with_spouse }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('needs_to_speak_with_spouse') }}</td>  
            <td>{{ $data['mtd']->sum('needs_to_speak_with_spouse') }}</td>  
            <td>{{ $data['ptd']->sum('needs_to_speak_with_spouse') }}</td>
        </tr>

        <tr>
            <td>Not Interested</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->not_interested }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('not_interested') }}</td>  
            <td>{{ $data['mtd']->sum('not_interested') }}</td>  
            <td>{{ $data['ptd']->sum('not_interested') }}</td>
        </tr>

        <tr>
            <td>Sent to Web for Financing - No Sale Secured</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->sent_to_web_for_financing_no_sale_secured }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('sent_to_web_for_financing_no_sale_secured') }}</td>  
            <td>{{ $data['mtd']->sum('sent_to_web_for_financing_no_sale_secured') }}</td>  
            <td>{{ $data['ptd']->sum('sent_to_web_for_financing_no_sale_secured') }}</td>
        </tr>

        <tr>
            <td>Too Expensive</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->too_expensive }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('too_expensive') }}</td>  
            <td>{{ $data['mtd']->sum('too_expensive') }}</td>  
            <td>{{ $data['ptd']->sum('too_expensive') }}</td>
        </tr>

        <tr>
            <td>Will Think About It</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->will_think_about_it }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('will_think_about_it') }}</td>  
            <td>{{ $data['mtd']->sum('will_think_about_it') }}</td>  
            <td>{{ $data['ptd']->sum('will_think_about_it') }}</td>
        </tr>

        <tr>
            <td>Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr>

        <tr>
            <td>Already a Customer</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->already_a_customer }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('already_a_customer') }}</td>  
            <td>{{ $data['mtd']->sum('already_a_customer') }}</td>  
            <td>{{ $data['ptd']->sum('already_a_customer') }}</td>
        </tr> 

        <tr>
            <td>Caller Hung Up (Less than 20 Sec)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->caller_hung_up_less_than_20_sec }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('caller_hung_up_less_than_20_sec') }}</td>  
            <td>{{ $data['mtd']->sum('caller_hung_up_less_than_20_sec') }}</td>  
            <td>{{ $data['ptd']->sum('caller_hung_up_less_than_20_sec') }}</td>
        </tr> 

        <tr>
            <td>Customer Care (After-Hours)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->customer_care_after_hours }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('customer_care_after_hours') }}</td>  
            <td>{{ $data['mtd']->sum('customer_care_after_hours') }}</td>  
            <td>{{ $data['ptd']->sum('customer_care_after_hours') }}</td>
        </tr> 

        <tr>
            <td>Dead Air</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->dead_air }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('dead_air') }}</td>  
            <td>{{ $data['mtd']->sum('dead_air') }}</td>  
            <td>{{ $data['ptd']->sum('dead_air') }}</td>
        </tr> 

        <tr>
            <td>Do Not Call</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->do_not_call }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('do_not_call') }}</td>  
            <td>{{ $data['mtd']->sum('do_not_call') }}</td>  
            <td>{{ $data['ptd']->sum('do_not_call') }}</td>
        </tr>

        <tr>
            <td>Fax Machine / Telephone Problem</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->fax_machine_telephone_problem }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('fax_machine_telephone_problem') }}</td>  
            <td>{{ $data['mtd']->sum('fax_machine_telephone_problem') }}</td>  
            <td>{{ $data['ptd']->sum('fax_machine_telephone_problem') }}</td>
        </tr>

        <tr>
            <td>Language Barrier</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->language_barrier }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('language_barrier') }}</td>  
            <td>{{ $data['mtd']->sum('language_barrier') }}</td>  
            <td>{{ $data['ptd']->sum('language_barrier') }}</td>
        </tr> 

        <tr>
            <td>Other (Catch-All)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->other_catchall }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('other_catchall') }}</td>  
            <td>{{ $data['mtd']->sum('other_catchall') }}</td>  
            <td>{{ $data['ptd']->sum('other_catchall') }}</td>
        </tr> 

        <tr>
            <td>Prank Call</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->prank_call }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('prank_call') }}</td>  
            <td>{{ $data['mtd']->sum('prank_call') }}</td>  
            <td>{{ $data['ptd']->sum('prank_call') }}</td>
        </tr> 

        <tr>
            <td>Test Call</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->test_call }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('test_call') }}</td>  
            <td>{{ $data['mtd']->sum('test_call') }}</td>  
            <td>{{ $data['ptd']->sum('test_call') }}</td>
        </tr>

        <tr>
            <td>Transfer (Customer Care)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->transfer_customer_service_question_issue }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('transfer_customer_service_question_issue') }}</td>  
            <td>{{ $data['mtd']->sum('transfer_customer_service_question_issue') }}</td>  
            <td>{{ $data['ptd']->sum('transfer_customer_service_question_issue') }}</td>
        </tr>

        <tr>
            <td>Transfer (Other)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->transfer_physician_doctor }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('transfer_physician_doctor') }}</td>  
            <td>{{ $data['mtd']->sum('transfer_physician_doctor') }}</td>  
            <td>{{ $data['ptd']->sum('transfer_physician_doctor') }}</td>
        </tr>

        <tr>
            <td>Wrong Number</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->wrong_number }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('wrong_number') }}</td>  
            <td>{{ $data['mtd']->sum('wrong_number') }}</td>  
            <td>{{ $data['ptd']->sum('wrong_number') }}</td>
        </tr>

        <tr>
            <td>Non-Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td>
        </tr>  
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}