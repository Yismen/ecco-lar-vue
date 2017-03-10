@extends('escalations_admin.home')

@section('views')
    
    <div class="row">
        <div class="col-sm-12">

            {!! Form::open(['url'=>['/admin/escalations_admin/bbbs'], 'method'=>'GET', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
                <legend>Search BBBs Records</legend>

                 <!-- Production Date -->
                <div class="col-sm-12">
                    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                        {!! Form::label('date', 'Production Date:', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!}   
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                         Search BBBs
                                    </button>
                                </span>     
                            </div>
                            {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
            
                
            
            {!! Form::close() !!}

            @if (isset($records))
                <hr>
                <div class="col-sm-12">
                    <div class="page-header">Results for Date[{{ Request::old('date') }}] </div>
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
                                                <td>{{ $record->created_at->format('M-d-Y') }}</td>
                                                <td>{{ $record->tracking }}</td>
                                                <td>{{ $record->client->name }}</td>
                                                <td>{{ $record->user->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- <canvas id="clientsChart" height="100%" width="60px"></canvas> --}}
                        </div>
                    </div>

                @endunless


            @endif
        </div>
    </div>
@stop