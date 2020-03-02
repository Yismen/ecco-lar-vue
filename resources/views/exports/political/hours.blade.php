<table>
    <tbody>
        <tr>
            <th>Dial Group</th>
            <th>Total Hours</th>
        </tr>

        @foreach ($data as $row)
            <tr>
                <td>{{ collect($row)->get('Dial Group') }}</td>
                <td>{{ collect($row)->get('TotalHours') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}