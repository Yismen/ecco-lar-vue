<table>
    <tbody>
        <tr>
            <th>source_type</th>
            <th>source_group_name</th>
            <th>source_name</th>
            <th>source_description</th>
            <th>call_result</th>
            <th>connected_disposition</th>
            <th>dial_type</th>
            <th>num_calls</th>
        </tr>

        @foreach ($data as $row)
            @php
                $row = collect($row);
            @endphp
            <tr>
                <td>{{ $row->get('source_type') }}</td>
                <td>{{ $row->get('source_group_name') }}</td>
                <td>{{ $row->get('source_name') }}</td>
                <td>{{ $row->get('source_description') }}</td>
                <td>{{ $row->get('call_result') }}</td>
                <td>{{ $row->get('connected_disposition') }}</td>
                <td>{{ $row->get('dial_type') }}</td>
                <td>{{ $row->get('num_calls') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}