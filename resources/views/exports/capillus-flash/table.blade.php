<h4>{{ $date }}</h4>
<table>
    <thead>
        <tr>
            <th>Window</th>
            <th>Calls Offered</th>
            <th>Calls Rerouted</th>
            <th>Calls Accepted</th>
            <th>Calls Answered</th>
            <th>Short Abandons</th>
            <th>Short Abandon Rate</th>
            <th>Long Abandons</th>
            <th>Long Abandon Rate</th>
            <th>Qualified Call %</th>
            <th>Non-Qualified Call %</th>
            <th>Total Cap Sales</th>
            <th>Cap Ultra</th>
            <th>Cap Plus</th>
            <th>Cap Pro</th>
            <th>Total Revenue</th>
            <th>Revenue Per Call Offered</th>
            <th>Revenue Per Call Answered</th>
            <th>Revenue Per Qualified Call</th>
            <th>Qualified Calls</th>
            <th>Non-Qualified Calls</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($windows as $window)
            @php
                $window = json_decode(json_encode($window), true)
            @endphp
            <tr>
                <td>{{ $window['window'] }}</td>
                <td>{{ $window['Calls Offered'] }}</td>
                <td>{{ $window['Calls Rerouted'] }}</td>
                <td>{{ $window['Calls Accepted'] }}</td>
                <td>{{ $window['Calls Answered'] }}</td>
                <td>{{ $window['Short Abandons'] }}</td>
                <td>{{ $window['Short Abandon Rate'] }}</td>
                <td>{{ $window['Long Abandons'] }}</td>
                <td>{{ $window['Long Abandon Rate'] }}</td>
                <td>{{ $window['Qualified Call %'] }}</td>
                <td>{{ $window['Non-Qualified Call %'] }}</td>
                <td>{{ $window['Total Cap Sales'] }}</td>
                <td>{{ $window['Cap Ultra'] }}</td>
                <td>{{ $window['Cap Plus'] }}</td>
                <td>{{ $window['Cap Pro'] }}</td>
                <td>{{ $window['Total Revenue'] }}</td>
                <td>{{ $window['Revenue Per Call Offered'] }}</td>
                <td>{{ $window['Revenue Per Call Answered'] }}</td>
                <td>{{ $window['Revenue Per Qualified Call'] }}</td>
                <td>{{ $window['Qualified Calls'] }}</td>
                <td>{{ $window['Non-Qualified Calls'] }}</td>
            </tr> 
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            @php 
                $collection = collect($windows);
                $total_calls = $collection->sum('Calls Offered');
                $total_calls_rerouted = $collection->sum('Calls Rerouted');
                $total_calls_accepted = $collection->sum('Calls Accepted');
                $total_calls_answered = $collection->sum('Calls Answered');
                $total_short_abandons = $collection->sum('Short Abandons');
                $total_long_abandons = $collection->sum('Long Abandons');

                $qualified_calls = $collection->sum('Qualified Calls');
                $non_qualified_calls = $collection->sum('Non-Qualified Calls');
                $total_valid_calls = $qualified_calls + $non_qualified_calls;

                $total_revenue = $collection->sum('Total Revenue');
             @endphp
            <th>Totals</th>
            <th>{{ $total_calls }}</th>
            <th>{{ $total_calls_rerouted }}</th>
            <th>{{ $total_calls_accepted }}</th>
            <th>{{ $total_calls_answered }}</th>
            <th>{{ $total_short_abandons }}</th>
            <th>{{ $total_calls == 0 ? 0: $total_short_abandons / $total_calls }}</th>
            <th>{{ $total_long_abandons }}</th>
            <th>{{ $total_calls == 0 ? 0: $total_long_abandons / $total_calls }}</th>
            <th>{{ $total_valid_calls == 0 ? 0 : $qualified_calls / $total_valid_calls }}</th>
            <th>{{ $total_valid_calls == 0 ? 0 : $non_qualified_calls / $total_valid_calls }}</th>
            <th>{{ $collection->sum('Total Cap Sales') }}</th>
            <th>{{ $collection->sum('Cap Ultra') }}</th>
            <th>{{ $collection->sum('Cap Plus') }}</th>
            <th>{{ $collection->sum('Cap Pro') }}</th>
            <th>{{ $total_revenue }}</th>
            <th>{{ $total_calls == 0 ? 0 : $total_revenue / $total_calls }}</th>
            <th>{{ $total_calls_answered == 0 ? 0 : $total_revenue / $total_calls_answered }}</th>
            <th>{{ $qualified_calls == 0 ? 0 : $total_revenue / $qualified_calls }}</th>
            <th>{{ $qualified_calls }}</th>
            <th>{{ $non_qualified_calls }}</th>
        </tr>
    </tfoot>
</table>