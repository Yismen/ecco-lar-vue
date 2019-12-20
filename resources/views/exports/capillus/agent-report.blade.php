<table>
    <tbody>
        <tr>
            <th>Agent</th>
            <th>First Day Handling Calls</th>
            <th>Calls Answered</th>
            <th>OB Call Backs</th>
            <th>Qualified %</th>
            <th>Non-Qualified %</th>
            <th colspan="3">Sales Counts</th>
            <th>Revenue</th>
            <th colspan="2">Revenue Per</th>
            <th colspan="2">Conversion Against</th>
            <th colspan="3">Average Talk Time</th>
            <th colspan="3">Average Handling Time</th>
        </tr>

        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Cap 82</th>
            <th>Cap 202</th>
            <th>Cap Pro</th>
            <th></th>
            <th>Answered Call</th>
            <th>Qualified Call</th>
            <th>Answered Calls</th>
            <th>Qualified Calls</th>
            <th>Sales</th>
            <th>Non-Sales</th>
            <th>All Calls</th>
            <th>Sales</th>
            <th>Non-Sales</th>
            <th>All Calls</th>
        </tr>

        @foreach ($data as $row)
            <tr>
                <td>{{ collect($row)->get('Agent') }}</td>
                <td>{{ collect($row)->get('First Day Handling Calls') }}</td>
                <td>{{ collect($row)->get('Calls Answered') }}</td>
                <td>{{ collect($row)->get('OB Call Backs') }}</td>
                <td>{{ collect($row)->get('Qualified %') }}</td>
                <td>{{ collect($row)->get('Non-Qualified %') }}</td>
                <td>{{ collect($row)->get('Cap Ultra') }}</td>
                <td>{{ collect($row)->get('Cap Plus') }}</td>
                <td>{{ collect($row)->get('Cap Pro') }}</td>
                <td>{{ collect($row)->get('Revenue') }}</td>
                <td>{{ collect($row)->get('Revenue Per Answered Call') }}</td>
                <td>{{ collect($row)->get('Revenue Per Qualified Call') }}</td>
                <td>{{ collect($row)->get('Conversion Against Answered Calls') }}</td>
                <td>{{ collect($row)->get('Conversion Against Qualified Calls') }}</td>
                <td>{{ collect($row)->get('ATT Sales')/60/60/24 }}</td>
                <td>{{ collect($row)->get('ATT Non-Sales')/60/60/24 }}</td>
                <td>{{ collect($row)->get('ATT All Calls')/60/60/24 }}</td>
                <td>{{ collect($row)->get('AHT Sales')/60/60/24 }}</td>
                <td>{{ collect($row)->get('AHT Non-Sales')/60/60/24 }}</td>
                <td>{{ collect($row)->get('AHT All Calls')/60/60/24 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}