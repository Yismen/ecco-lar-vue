<h4>{{ $dispositionsTitle }}</h4>
<table>
    <tbody>
        <tr>
            <th>Campaign</th>
            <th>Disposition</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Total</th>
            <th>Percentage</th>
        </tr>
        @foreach ($data as $row)
            <tr>
                @php
                    $totalForCampaign = collect($data)->where('dial_group_name', $row->dial_group_name)->sum('dispo_count');
                @endphp
                <td>{{ $row->dial_group_name }}</td>
                <td>{{ $row->agent_disposition }}</td>
                <td>{{ $row->date_from }}</td>
                <td>{{ $row->date_to }}</td>
                <td>{{ $row->dispo_count }}</td>
                <td>{{ $totalForCampaign > 0 ? $row->dispo_count / $totalForCampaign : 0 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}