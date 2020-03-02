<h3>{{ $campaign }} </h3>
<h4>Dispositions</h4>
<table>
    <tbody>
        <tr>
            <th>Disposition</th>
            <th>Total Leads</th>
        </tr>

        @foreach ($dispositions as $disposition)
            <tr>
                <td>{{ collect($disposition)->get('disposition') }}</td>
                <td>{{ collect($disposition)->get('num_leads') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<h4>Answers</h4>
<table>
    <tbody>
        @foreach ($answers as $answer)
            <tr>
                @foreach ($answer as $key => $value)
                    @if ($loop->iteration > 5)
                        @if ($loop->parent->first)
                            <td>{{ $key }}</td>
                        @else
                            <td>{{ $value }} </td>
                        @endif
                    @endif
                @endforeach 
            </tr>
        @endforeach
    </tbody>
</table>

{{-- $repo->data['mtd']->sum('calls_offered') --}}