<h4>{{ $date }}</h4>
<table>
    <thead>
        <tr>
            <th>Window</th>
            <th>Calls Offered</th>
            <th>Calls Answered</th>
            <th>IVR Disconnects</th>
            <th>IVR Disconnect Rate</th>
            <th>Calls Abandoned</th>
            <th>Abandonment Rate</th>
            <th>Sales</th>
            <th>Qualified Call %</th>
            <th>Non-Qualified Call %</th>
            <th>Gross Conversion</th>
            <th>Net Conversion</th>
            <th>Qualified Conversion</th>
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
                <td>{{ $window['Calls Answered'] }}</td>
                <td>{{ $window['IVR Disconnects'] }}</td>
                <td>{{ $window['IVR Disconnect Rate'] }}</td>
                <td>{{ $window['Calls Abandoned'] }}</td>
                <td>{{ $window['Abandonment Rate'] }}</td>
                <td>{{ $window['Sales'] }}</td>
                <td>{{ $window['Qualified Call %'] }}</td>
                <td>{{ $window['Non-Qualified Call %'] }}</td>
                <td>{{ $window['Gross Conversion'] }}</td>
                <td>{{ $window['Net Conversion'] }}</td>
                <td>{{ $window['Qualified Conversion'] }}</td>
                <td>{{ $window['Qualified Calls'] }}</td>
                <td>{{ $window['Non-Qualified Calls'] }}</td>
            </tr> 
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            @php 
                $collection = collect($windows);
                $calls_offered = $collection->sum('Calls Offered');
                $calls_answered = $collection->sum('Calls Answered');
                $qualified_calls = $collection->sum('Qualified Calls');
                $non_qualified_calls = $collection->sum('Non-Qualified Calls');
                $ivr_abandoned = $collection->sum('IVR Abandoned');
                $sales = $collection->sum('Sales');
                $ivr_disconnects = $collection->sum('IVR Disconnects');
             @endphp
            <th>Totals</th>
            <th>{{ $calls_offered }}</th>
            <th>{{ $calls_answered }}</th>
            <th>{{ $ivr_disconnects }}</th>
            <th>{{ $calls_offered == 0 ? 0 : $ivr_disconnects / $calls_offered }}</th>
            <th>{{ $ivr_abandoned }}</th>
            <th>{{ $calls_offered == 0 ? 0 : $ivr_abandoned / $calls_offered }}</th>
            <th>{{ $sales }}</th>
            <th>{{ $calls_answered == 0 ? 0 : $qualified_calls / $calls_answered }}</th>
            <th>{{ $calls_answered == 0 ? 0 : $non_qualified_calls / $calls_answered }}</th>
            <th>{{ $calls_offered == 0 ? 0 : $sales / $calls_offered }}</th>
            <th>{{ $calls_answered == 0 ? 0 : $sales / $calls_answered }}</th>
            <th>{{ $qualified_calls == 0 ? 0 : $sales / $qualified_calls }}</th>
            <th>{{ $qualified_calls }}</th>
            <th>{{ $non_qualified_calls }}</th>
        </tr>
    </tfoot>
</table>