@php
    $terminations = $terminations->except([optional($employee->termination)->id]);
@endphp
@if ($terminations->count() > 0)
    <hr>
    <h4>
        Employee Past Terminations 
        <span class="badge bg-red">{{ $terminations->count() }} </span>:
    </h4>
    
    <table class="table table-condensed table-hover" >
        <thead>
            <tr>
                <th>Date:</th>
                <th>Type:</th>
                <th>Reason:</th>
                <th>Comments:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($terminations as $termination)								
                <tr class=" bg-danger">
                    <td>{{ $termination->termination_date->format('d/M/y') }} </td>
                    <td>{{ optional($termination->terminationType)->name }} </td>
                    <td>{{ optional($termination->terminationReason)->reason }} </td>
                    <td>{{ $termination->comments }} </td>
                </tr>	
            @endforeach
        </tbody>
    </table>
@endif