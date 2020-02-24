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
            <th>Connected Disposition</th>
            <th>comments</th>
        </tr>

        @foreach ($data as $row)
            <tr>
                <td>{{ \Carbon\Carbon::parse(collect($row)->get('Date'))->format('m/d/Y') }}</td>
                <td>{{ collect($row)->get('Time') }}</td>
                <td>{{ collect($row)->get('ANI') }}</td>
                <td>{{ collect($row)->get('CBR') }}</td>
                <td>{{ collect($row)->get('Fname') }}</td>
                <td>{{ collect($row)->get('Lname') }}</td>
                <td>{{ collect($row)->get('Email') }}</td>
                <td>{{ collect($row)->get('StreetAddress') }}</td>
                <td>{{ collect($row)->get('City') }}</td>
                <td>{{ collect($row)->get('State') }}</td>
                <td>{{ collect($row)->get('Zip Code') }}</td>
                <td>{{ collect($row)->get('Country') }}</td>
                <td>{{ collect($row)->get('Interested In') }}</td>
                <td>{{ collect($row)->get('connected_disposition') }}</td>
                <td>{{ collect($row)->get('Comments') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}