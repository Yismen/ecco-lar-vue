<table>
    <tbody>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>ANI</th>
            <th>CBR</th>
            <th>FName</th>
            <th>LName</th>
            <th>Email</th>
            <th>Street Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th>Country</th>
            <th>Interested In</th>
            <th>Disposition</th>
            <th>comments</th>
        </tr>

        @foreach ($data as $row)
            @php
                $row = collect($row);
            @endphp
            <tr>
                <td>{{ \Carbon\Carbon::parse($row->get('Date'))->format('Y-m-d') }}</td>
                <td>{{ $row->get('Time') }}</td>
                <td>{{ str_replace(['-', '(', ')'], '', $row->get('ANI')) }}</td>
                <td>{{ str_replace(['-', '(', ')'], '', $row->get('CBR')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('Fname')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('Lname')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('Email')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('StreetAddress')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('City')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('State')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('Zip Code')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('Country')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('Interested In')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('connected_disposition')) }}</td>
                <td>{{ str_replace(['"'], "", $row->get('Comments')) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}