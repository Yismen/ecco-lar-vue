<table>
    <thead>
        <tr><th colspan="11">Daily Performance Report - {{ $title }}</th></tr>
        <tr><td colspan="11"></td></tr>
        <tr><td colspan="11">Because Market</td></tr>
        <tr><td colspan="11"></td></tr>
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
                <td>{{ $day->calls }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('calls') }}</td>  
            <td>{{ $data['mtd']->sum('calls') }}</td>  
            <td>{{ $data['ptd']->sum('calls') }}</td>
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
            <td>Disconnect During Automated Greeting</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->ivr_disconnects }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('ivr_disconnects') }}</td>  
            <td>{{ $data['mtd']->sum('ivr_disconnects') }}</td>  
            <td>{{ $data['ptd']->sum('ivr_disconnects') }}</td>
        </tr>

        <tr>
            <td>Automated Greeting Disconnect Rate</td>    
            {{-- @foreach ($data['wtd'] as $day)
                <td>{{ $day->ivr_disconnects }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('ivr_disconnects') }}</td>  
            <td>{{ $data['mtd']->sum('ivr_disconnects') }}</td>  
            <td>{{ $data['ptd']->sum('ivr_disconnects') }}</td> --}}
        </tr>

        <tr>
            <td>Abandoned Calls</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->abandon }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('abandon') }}</td>  
            <td>{{ $data['mtd']->sum('abandon') }}</td>  
            <td>{{ $data['ptd']->sum('abandon') }}</td>
        </tr> 

        <tr>
            <td>Abandon Rate</td>    
            {{-- @foreach ($data['wtd'] as $day)
                <td>{{ $day->short_abandons }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('short_abandons') }}</td>  
            <td>{{ $data['mtd']->sum('short_abandons') }}</td>  
            <td>{{ $data['ptd']->sum('short_abandons') }}</td> --}}
        </tr> 

        <tr>
            <td>% of Qualified Calls</td>    
            {{-- @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td> --}}
        </tr> 

        <tr>
            <td>% of Non-Qualified Calls</td>
            {{-- @foreach ($data['wtd'] as $day)
                <td>{{ $day->long_abandons }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('long_abandons') }}</td>  
            <td>{{ $data['mtd']->sum('long_abandons') }}</td>  
            <td>{{ $data['ptd']->sum('long_abandons') }}</td> --}}
        </tr> 

        <tr>
            <td>Gross Conversion Rate</td>
            {{-- @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td> --}}
        </tr>

        <tr>
            <td>Net Conversion Rate</td>    
            {{-- @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td> --}}
        </tr>

        <tr>
            <td>Qualified Conversion Rate</td>    
            {{-- @foreach ($data['wtd'] as $day)
                <td></td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td></td>  
            <td></td>  
            <td></td> --}}
        </tr> 

        <tr>
            <td>Total Talk Time Minutes</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->duration }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('duration') }}</td>  
            <td>{{ $data['mtd']->sum('duration') }}</td>  
            <td>{{ $data['ptd']->sum('duration') }}</td>
        </tr>
        
        <tr>
            <td></td>
        </tr>

        <tr>
            <td colspan="11">Disposition Breakout</td>
        </tr> 

        <tr>
            <td>Sales</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->sale }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('sale') }}</td>  
            <td>{{ $data['mtd']->sum('sale') }}</td>  
            <td>{{ $data['ptd']->sum('sale') }}</td>
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
            <td>No Credit / Debit Card</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->no_credit_or_debit_card }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('no_credit_or_debit_card') }}</td>  
            <td>{{ $data['mtd']->sum('no_credit_or_debit_card') }}</td>  
            <td>{{ $data['ptd']->sum('no_credit_or_debit_card') }}</td>
        </tr> 

        <tr>
            <td>Wants Product but Not Subscription</td>      
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->wants_product_but_not_subscription }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('wants_product_but_not_subscription') }}</td>  
            <td>{{ $data['mtd']->sum('wants_product_but_not_subscription') }}</td>  
            <td>{{ $data['ptd']->sum('wants_product_but_not_subscription') }}</td>
        </tr> 

        <tr>
            <td>Objects to Auto-Renew</td>      
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->objects_to_autorenew }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('objects_to_autorenew') }}</td>  
            <td>{{ $data['mtd']->sum('objects_to_autorenew') }}</td>  
            <td>{{ $data['ptd']->sum('objects_to_autorenew') }}</td>
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
            <td>Doesnt want to pay with Credit-Debit Card</td>      
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->doesnt_want_to_pay_with_creditdebit_card }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('doesnt_want_to_pay_with_creditdebit_card') }}</td>  
            <td>{{ $data['mtd']->sum('doesnt_want_to_pay_with_creditdebit_card') }}</td>  
            <td>{{ $data['ptd']->sum('doesnt_want_to_pay_with_creditdebit_card') }}</td>
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
            <td>Caller Hung Up During Pitch</td>      
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->caller_hung_up_during_pitch }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('caller_hung_up_during_pitch') }}</td>  
            <td>{{ $data['mtd']->sum('caller_hung_up_during_pitch') }}</td>  
            <td>{{ $data['ptd']->sum('caller_hung_up_during_pitch') }}</td>
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
            <th>Qualified Calls</th>
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
            <td>Fax Machine / Telephone Problem</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->fax_machine_or_telephone_problem }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('fax_machine_or_telephone_problem') }}</td>  
            <td>{{ $data['mtd']->sum('fax_machine_or_telephone_problem') }}</td>  
            <td>{{ $data['ptd']->sum('fax_machine_or_telephone_problem') }}</td>
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
            <td>Customer Care (After-Hours)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->customer_care_afterhours }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('customer_care_afterhours') }}</td>  
            <td>{{ $data['mtd']->sum('customer_care_afterhours') }}</td>  
            <td>{{ $data['ptd']->sum('customer_care_afterhours') }}</td>
        </tr>

        <tr>
            <td>Customer Care (Transferred)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->customer_care_transferred }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('customer_care_transferred') }}</td>  
            <td>{{ $data['mtd']->sum('customer_care_transferred') }}</td>  
            <td>{{ $data['ptd']->sum('customer_care_transferred') }}</td>
        </tr>

        <tr>
            <td>Other Transfer</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->transfer_customer_care }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('transfer_customer_care') }}</td>  
            <td>{{ $data['mtd']->sum('transfer_customer_care') }}</td>  
            <td>{{ $data['ptd']->sum('transfer_customer_care') }}</td>
        </tr>

        <tr>
            <td>Caller Hung Up Before Pitch</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->caller_hung_up_before_branding }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('caller_hung_up_before_branding') }}</td>  
            <td>{{ $data['mtd']->sum('caller_hung_up_before_branding') }}</td>  
            <td>{{ $data['ptd']->sum('caller_hung_up_before_branding') }}</td>
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
            <td>Sent to Care for Cancel</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->cancel_order }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('cancel_order') }}</td>  
            <td>{{ $data['mtd']->sum('cancel_order') }}</td>  
            <td>{{ $data['ptd']->sum('cancel_order') }}</td>
        </tr>

        <tr>
            <td>Miscellaneous (Other)</td>    
            @foreach ($data['wtd'] as $day)
                <td>{{ $day->transfer_not_customer_care_issue }}</td>
            @endforeach

            @for ($i = count($data['wtd']); $i < 7; $i++)
                <td></td>
            @endfor
            <td>{{ $data['wtd']->sum('transfer_not_customer_care_issue') }}</td>  
            <td>{{ $data['mtd']->sum('transfer_not_customer_care_issue') }}</td>  
            <td>{{ $data['ptd']->sum('transfer_not_customer_care_issue') }}</td>
        </tr>

        <tr>
            <th>Non-Qualified Calls</th>
        </tr>
    </tbody>
</table>
