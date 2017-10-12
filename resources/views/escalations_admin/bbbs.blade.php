@extends('escalations_admin.home')

@section('views')
    
    <div class="row">

        <div class="col-sm-4">
            @include('escalations_admin.partials._bbb_form_date')            
        </div>
        {{-- /. By Date --}}
        <div class="col-sm-8">
            @include('escalations_admin.partials._bbb_form_range')
        </div>
        {{-- /. By Range --}}        
    </div>

    <div class="row">
        <div class="col-sm-12">

            @if (isset($records))
                <hr>
                <div class="col-sm-12">
                    @if (Request::old('date'))
                        <div class="page-header">Results for Date [{{ Request::old('date') }}] </div>
                    @else
                        <div class="page-header">Results for Range [{{ Request::old('from') }} to {{ Request::old('to') }}] </div>
                    @endif
                    
                </div>

                @unless ($records->count() > 0 )
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Plese Review!</strong> No BBB records reported for this date ...
                        </div>
                    </div>
                @else

                    <div class="col-sm-12">
                        <div class="box box-success">
                            <div class="table-responsive">
                                <h3>Records reported as BBB</h3>
                                <table class="table table-hover table-striped table-condenssed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date:</th>
                                            <th>Tracking Number:</th>
                                            <th>Queue:</th>
                                            <th>Reported By:</th>
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
        </div>
    </div>
@stop