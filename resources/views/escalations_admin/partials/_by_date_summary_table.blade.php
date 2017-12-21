@if(isset($summary))
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="table-responsive">
                <h3>Summary</h3>
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Date:</th>
                            <th>Client:</th>
                            <th>Agent:</th>
                            <th>Hours:</th>
                            <th>Count:</th>
                            <th>TP:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summary as $record)
                            <tr class="{{ $record->escalation_hours_id ? '' : 'danger' }}">
                                <td>{{ $record->insert_date->format('d/M/Y') }}</td>
                                <td>{{ $record->escal_client->name }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>
                                    @if ($record->escalation_hours_id)
                                        <a href="{{ route('admin.escalations_hours.edit', $record->escalation_hours_id) }}" target="_new">
                                            {{ $production_hours = number_format(
                                                $record->escalation_hours_production_hours
                                            , 2) }} 
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.escalations_hours.create', [$record->escal_records_user_id, $record->escal_records_escal_client_id, $record->escal_records_insert_date]
                                        ) }}" target="_blanc">
                                            <i class="fa fa-plus"></i> {{ $production_hours = '' }}Create
                                        </a>
                                    @endif
                                        
                                </td>
                                <td>
                                    {{ $record->records }} 
                                </td> 
                                <td>
                                    {{ number_format($record->productivity($record->records, $production_hours), 2) }} 
                                </td>
                            </tr>
                        @endforeach                            
                    </tbody>
                    <tfoot> 
                        <th colspan="3">Total:</th>
                        {{-- <th>{{ $summary->hour()->count() }}</th> --}}
                        <th>{{ number_format($summary->sum('escalation_hours_production_hours'), 2) }}</th>
                        <th>{{ number_format($summary->sum('records')) }}</th>
                        <th>{{ 
                            $summary->sum('escalation_hours_production_hours') > 0 ?
                            number_format($summary->sum('records') / $summary->sum('escalation_hours_production_hours'), 2) : 
                            0.00
                        }}
                        </th>

                    </tfoot>
                </table>
        </div>
    </div>
@endif