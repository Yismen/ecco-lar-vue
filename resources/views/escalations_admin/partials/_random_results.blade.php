@if (isset($records))
    <hr>
    @unless ($records->count() > 0)
        <div class="col-sm-12">
            <div class="alert alert-warning">
                <strong>Please try again!</strong> We couldn't find any record with these chriterias ...
            </div>
        </div>
    @else
        <div class="col-sm-12">
            <div class="page-header">
                Results of Random Records
            </div>
        </div>

        <div class="col-sm-12">

            <div class="box box-success">
                <h3>
                    Results of {{ Request::old('records') }} Random Records for Period [{{ Request::old('from') }} - {{ Request::old('to') }}]
                </h3>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>Insert Date:</th>
                                <th>Tracking Number:</th>
                                <th>Queue:</th>
                                <th>Agent Name:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $record->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $record->tracking }}</td>
                                    <td>{{ $record->client->name }}</td>
                                    <td>{{ $record->user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @endunless
        

@endif