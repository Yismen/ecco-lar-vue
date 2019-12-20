<table>
    <tbody>
        <tr>
            <th>Call Date</th>
            <th>Call Time</th>
            <th>Call Direction</th>
            <th>Agent Name</th>
            <th>Segment</th>
            <th>Disposition</th>
            <th>ANI</th>
            <th>DNIS</th>
            <th>Speed of Answer</th>
            <th>Talk Time</th>
            <th>After Call Work</th>
            <th>Time to Abandon</th>
            <th>Total Duration</th>
        </tr>

        @foreach ($data as $row)
            <tr>
                <td>{{ \Carbon\Carbon::parse(collect($row)->get('DATE'))->format('m/d/Y') }}</td>
                <td>{{ collect($row)->get('TIME') }}</td>
                <td>{{ collect($row)->get('Call Direction') }}</td>
                <td>{{ collect($row)->get('Agent Name') }}</td>
                <td>{{ collect($row)->get('Segment') }}</td>
                <td>{{ collect($row)->get('Disposition') }}</td>
                <td>{{ collect($row)->get('ANI') }}</td>
                <td>{{ collect($row)->get('DNIS') }}</td>
                <td>{{ collect($row)->get('Speed of Answer (mins)')/60/24 }}</td>
                <td>{{ collect($row)->get('Talk Time (mins)')/60/24 }}</td>
                <td>{{ collect($row)->get('After Call Work (mins)')/60/24 }}</td>
                <td>{{ collect($row)->get('Time to Abandon (mins)')/60/24 }}</td>
                <td>{{ collect($row)->get('Total Duration (mins)')/60/24 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}