@if(isset($summary))
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="table-responsive">
                <h3>Summary</h3>
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Client:</th>
                            <th>Agent:</th>
                            <th>Count:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summary as $record)
                            <tr>
                                <td>{{ $record->escal_client->name }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ $record->records }}</td>
                            </tr>
                        @endforeach                            
                    </tbody>
                    <tfoot> 
                        <th colspan="2">Total:</th>
                        <th>{{ $summary->sum('records') }}</th>
                    </tfoot>
                </table>
        </div>
    </div>
@endif