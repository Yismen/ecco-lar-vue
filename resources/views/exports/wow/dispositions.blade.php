<h4>CTV WOW Dispositions</h4>
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
        @php
            $total_dispos = collect($data)->sum('dispo_count');
        @endphp
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->campaign_name }}</td>
                <td>{{ $row->agent_disposition }}</td>
                <td>{{ $row->date_from }}</td>
                <td>{{ $row->date_to }}</td>
                <td>{{ $row->dispo_count }}</td>
                <td>{{ $total_dispos > 0 ? $row->dispo_count / $total_dispos : 0 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}