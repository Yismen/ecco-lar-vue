<div class="row">
    <div class="box-body">
            
        @if (isset($records))
            <div class="col-md-6">
                @if ($records->count() > 0)
                    <div class="box box-success">

                        <h3>Records With Hours Reported</h3>
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Client</th>
                                    <th>Records</th>
                                    <th>Hours</th>
                                    <th>TP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr>
                                        <td>{{ $record->insert_date->format('d/M/Y') }}</td>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ $record->escal_client->name }}</td>
                                        <td>{{ $record->records }}</td>
                                        <td>
                                            <a href="{{ route('admin.escalations_hours.edit', $record->hour->id) }}">
                                                <i class="fa fa-edit"></i>{{ number_format($record->hour->production_hours, 2) }}
                                            </a>
                                        </td>
                                        <td>{{ number_format($record->records / $record->hour->production_hours, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">
                                        <span class="pull-right">Total</span>
                                    </th>
                                    <th>{{ $records->sum('records') }}</th>
                                    <th>{{ $records->sum('hour.production_hours') }}</th>
                                    <th>{{ number_format($records->sum('records') / $records->sum('hour.production_hours'), 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <strong>Not Found!</strong> Nothing found for date [{{ Request::old('date') }}]
                    </div>
                @endif
            </div>

        @endif
        
        @if (isset($pending_records))
            <div class="col-md-6">
                @if ($pending_records->count() > 0)
                    <div class="box box-warning">
                        <h3>Records Pending of Hours</h3>
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Client</th>
                                    <th>Records</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending_records as $record)
                                    <tr>
                                        <td>{{ $record->insert_date->format('d/M/Y') }}</td>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ $record->escal_client->name }}</td>
                                        <td>{{ $record->records }}</td>
                                        <td>
                                            {{-- <a href="/admin/escalations_hours/add/{{ $record->user->id }}/{{ $record->escal_client->id }}"> --}}
                                            <a href="{{ route('admin.escalations_hours.create', [$record->user->id, $record->escal_client->id, $record->records]) }}">
                                                <i class="fa fa-plus"></i> Add
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif(isset($records) && $records->count() > 0)
                    <div class="alert alert-info">
                        <strong>All Clear!</strong> No more records pending of hours.
                    </div>
                @endif
            </div>
                
        @endif
    </div>
</div>


    