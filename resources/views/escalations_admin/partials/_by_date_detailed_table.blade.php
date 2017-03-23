@if (isset($detailed))
    <div class="col-sm-12">
        <div class="box box-danger">
            <div class="table-responsive">
                <h4>Detailed list of tracking numbers</h4>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Insert Date:</th>
                            <th>Client: </th>
                            <th>Created By: </th>
                            <th>Tracking Number: </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailed as $record)
                            <tr>
                                <td>{{ $record->insert_date }}</td>
                                <td>{{ $record->escal_client->name }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ $record->tracking }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total:</th>
                            <th>{{ $detailed->count() }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endif