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
            <th></th>
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
            <td></td>
            <td>All calls that hit the Telephony Switch</td>
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
            <td></td>
            <td>All calls that reach a live agent</td>
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
            <td></td>
            <td>Abandonded Calls with a duration </= 10 seconds as measured from the moment the call hits the Switch to the moment the call is abandoned.</td>
        </tr> 

        <tr>
            <td>Short Abandon Rate</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_offered <= 0 ? 0 : $day->short_abandons / $day->calls_offered }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_offered') <= 0 ? 0 : $data['wtd']->sum('short_abandons') / $data['wtd']->sum('calls_offered')  }}</td>  
            <td>{{ $data['mtd']->sum('calls_offered') <= 0 ? 0 : $data['mtd']->sum('short_abandons') / $data['mtd']->sum('calls_offered')  }}</td>  
            <td></td>
            <td>Total Short Abandons / Calls Offered</td>
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
            <td></td>
            <td>Abandons Calls with a duration > 10 seconds as measured from the moment the call hits the Switch to the moment the call is abandoned
                    Note: Depending on the duration of the IVR greeting, we may want to tweak this.</td>
        </tr> 

        <tr>
            <td>Long Abandon Rate</td>
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_offered <= 0 ? 0 : ($day->long_abandons / $day->calls_offered) }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_offered') <= 0 ? 0 : $data['wtd']->sum('long_abandons') / $data['wtd']->sum('calls_offered')  }}</td>  
            <td>{{ $data['mtd']->sum('calls_offered') <= 0 ? 0 : $data['mtd']->sum('long_abandons') / $data['mtd']->sum('calls_offered')  }}</td>  
            <td></td>
            <td>Total Long Abandons / Calls Offered</td>
        </tr>

        <tr>
            <td>% of Qualified Calls (Change the formula)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_offered <= 0 ? 0 : $day->long_abandons / $day->calls_offered }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_offered') <= 0 ? 0 : $data['wtd']->sum('long_abandons') / $data['wtd']->sum('calls_offered')  }}</td>  
            <td>{{ $data['mtd']->sum('calls_offered') <= 0 ? 0 : $data['mtd']->sum('long_abandons') / $data['mtd']->sum('calls_offered')  }}</td>  
            <td></td>
            <td>Qualified Calls / (Qualified Calls + Non-Qualified Calls)</td>
        </tr>

        <tr>
            <td>% of Non-Qualified Calls (Change the formula)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->calls_offered <= 0 ? 0 : $day->long_abandons / $day->calls_offered }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls_offered') <= 0 ? 0 : $data['wtd']->sum('long_abandons') / $data['wtd']->sum('calls_offered')  }}</td>  
            <td>{{ $data['mtd']->sum('calls_offered') <= 0 ? 0 : $data['mtd']->sum('long_abandons') / $data['mtd']->sum('calls_offered')  }}</td>  
            <td></td>
            <td>Non-Qualified Calls (Qualified Calls + Non-Qualified Calls)</td>
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
            <td></td>
            <td>Total Inbound Talk Time Minutes + Total Oubtound Dial Minutes + Total Outbound Talk Time Minutes.</td>
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
            <td></td>
            <td>Total Inbound Talk Time Minutes.</td>
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
            <td></td>
            <td>Total Outbound Dial and Talk Time Minutes.</td>
        </tr> 

        <tr>
            <td colspan="11">Sales Stats</td>
        </tr> 

        <tr>
            <td>Total Cap Sales</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->cap_ultra + $day->cap_plus + $day->cap_pro }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('cap_ultra') + $data['wtd']->sum('cap_plus') + $data['wtd']->sum('cap_pro') }}</td>  
            <td>{{ $data['mtd']->sum('cap_ultra') + $data['mtd']->sum('cap_plus') + $data['mtd']->sum('cap_pro') }}</td>  
            <td></td>
            <td>Total Cap 82 + Cap 202 + Cap Pro Sales</td>
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
            <td></td>
            <td>Count of Sale - Cap Ultra</td>
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
            <td></td>
            <td>Count of Sale - Cap Plus</td>
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
            <td></td>
            <td>Count of Sale - Cap Pro</td>
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
            <td></td>
            <td>(Cap Ultra Count x $999)+(Cap Plus Count x $1,999)+(Cap Pro Count x $2,999)</td>
        </tr> 

        <tr>
            <td>Revenue Per Calls Received</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
            <td></td>
            <td>Total Revenue / Calls Offered</td>
        </tr> 

        <tr>
            <td>Revenue Per Call Answered</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
            <td></td>
            <td>Total Revenue / Calls Answered</td>
        </tr> 

        <tr>
            <td>Revenue Per Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
            <td></td>
            <td>Total Revenue / Qualified Call</td>
        </tr> 

        <tr>
            <td>Conversion - Against Calls Received</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
            <td></td>
            <td>(Cap Ultra Count + Cap Plus Count + Cap Pro Count) / Calls Offered</td>
        </tr> 

        <tr>
            <td>Conversion - Against Calls Answered</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
            <td></td>
            <td>(Cap Ultra Count + Cap Plus Count + Cap Pro Count) / Calls Answered</td>
        </tr> 

        <tr>
            <td>Conversion - Against Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
            <td></td>
            <td>(Cap Ultra Count + Cap Plus Count + Cap Pro Count) / Calls Qualified Calls</td>
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
            <td></td>
            <td>Count only when the Call Back disposition is assigned to a record and it is the first time that ANI has called in</td>
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
            <td></td>
            <td>Caller Hung Up" Disposition is Assigned and Total Talk Time is >/=20 seconds</td>
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
            <td></td>
            <td>Caller indicates they do not have a credit card, debit card, or PayPal with which to pay</td>
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
            <td></td>
            <td>Caller is unwilling to pay using a credit or debit card</td>
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
            <td></td>
            <td>Caller indicates they do not have enough money to pay for the product</td>
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
            <td></td>
            <td>Caller asks questions and indicates they are just gathering information at the moment and not ready to purchase</td>
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
            <td></td>
            <td>Caller misunderstood the offer that was made during the commercial and is no longer interested in purchasing</td>
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
            <td></td>
            <td>Caller wants to confer with spouse before placing an order</td>
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
            <td></td>
            <td>Caller does not provide a specific reason for not wanting to place an order</td>
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
            <td></td>
            <td>Caller expressed interest in financing a Cap but did not walk through the process with the agent and no sale was secured.</td>
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
            <td></td>
            <td>Caller was interested in purchasing but declined due to price.</td>
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
            <td></td>
            <td>Caller indicated they need to think about it before placing an order</td>
        </tr>

        <tr>
            <td>Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
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
            <td></td>
            <td>Caller purchased in the past, is not calling to place another order, and does not need to speak with Customer Care</td>
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
            <td></td>
            <td>"Caller Hung Up" Disposition is Assigned and Total Talk Time is less than 20 seconds</td>
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
            <td></td>
            <td>Caller needed to speak with Customer Care but called in outside the Customer Care hours of operation</td>
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
            <td></td>
            <td>Agent answered the call but was met with silence on the other end, despite multiple attempts to communicate with caller</td>
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
            <td></td>
            <td>Caller has asked to be placed on our Do Not Call list</td>
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
            <td></td>
            <td>Agent answers but encounters a fax machine tone or issue with the phone connection that prohibits a conversation</td>
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
            <td></td>
            <td>Agent is unable to assist because caller is speaking a language other than English</td>
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
            <td></td>
            <td>Miscellaneous bucket for calls where the outcome does not fit into any other bucket</td>
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
            <td></td>
            <td>Prank caller</td>
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
            <td></td>
            <td>Test call placed to agent</td>
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
            <td></td>
            <td>Caller transferred to Customer Care</td>
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
            <td></td>
            <td>Caller transferred to Capillus' Internal team for a reason other than Customer Care</td>
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
            <td></td>
            <td>Caller dialed wrong number</td>
        </tr>

        <tr>
            <td>Non-Qualified Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td>formulas</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td>formulas</td>
            @endfor
            <td>formulas</td>  
            <td>formulas</td>  
            <td></td>
            <td></td>
        </tr>  
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}