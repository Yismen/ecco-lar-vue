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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summary as $record)
                            <tr>
                                <td>{{ $record->insert_date->format('d/M/Y') }}</td>
                                <td>{{ $record->escal_client->name }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ $record->hour->production_hours or 0}}</td>
                                <td>{{ $record->records }}</td>
                            </tr>
                        @endforeach                            
                    </tbody>
                    <tfoot> 
                        <th colspan="4">Total:</th>
                        {{-- <th>{{ $summary->hour()->count() }}</th> --}}
                        <th>{{ $summary->sum('records') }}</th>
                    </tfoot>
                </table>
        </div>
    </div>
@endif