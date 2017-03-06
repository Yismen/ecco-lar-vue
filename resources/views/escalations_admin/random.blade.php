@extends('escalations_admin.home')

@section('views')
    
    <div class="row">
        <div class="col-sm-12">

            {!! Form::open(['url'=>['/admin/escalations_admin/random'], 'method'=>'GET', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
                <legend>Search Records Randomly</legend>

                <div class="col-sm-12">
                    <!-- Select a User -->
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('user') ? 'has-error' : null }}">
                            {!! Form::label('user', 'Select a User:', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('user', [], null, ['class'=>'form-control input-sm']) !!}
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <!-- /. Select a User -->

                    <!-- Date -->
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                            {!! Form::label('date', 'Date:', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('date', [], null, ['class'=>'form-control input-sm']) !!}
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <!-- /. Date -->

                    <!-- Amount of Records -->
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : null }}">
                            {!! Form::label('amount', 'Amount of Records:', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::input('number', 'amount', null, ['class'=>'form-control', 'placeholder'=>'Amount of Records']) !!}        
                                {!! $errors->first('amount', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <!-- /. Amount of Records -->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fa fa-search"> Search</i>
                            </button>
                        </div>
                    </div>
                </div>

                
        // user, contextual date, amount to get
            
                
            
            {!! Form::close() !!}

            @if (isset($records))
                <hr>
                <div class="col-sm-12">
                    <div class="page-header">Results for Tracking [{{ Request::old('tracking') }}] </div>
                </div>

                @unless ($records->count() > 0 )
                    Not found
                @else

                    <div class="col-sm-12">
                        <div class="box box-success">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Client:</th>
                                            <th>Count:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $record)
                                            <tr>
                                                <td>{{ $record->tracking }}</td>
                                                <td>{{ $record->user->name }}</td>
                                                <td>{{ $record->client->name }}</td>
                                                <td>{{ $record->created_at->format('M/d/Y') }}</td>
                                                

                                                {{-- <td>{{ $record->escal_records_count }}</td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $records }}
                            </div>

                            {{-- <canvas id="clientsChart" height="100%" width="60px"></canvas> --}}
                        </div>
                    </div>

                @endunless


            @endif
        </div>
    </div>
@stop