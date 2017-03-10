@extends('escalations_admin.home')

@section('views')
    
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['url'=>['/admin/escalations_admin/random'], 'method'=>'GET', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
                <legend>Search Random Records by Range and Agents</legend>

                <div class="col-sm-12">
                    <!-- From -->
                    <div class="col-sm-4">
                      <div class="form-group {{ $errors->has('from') ? 'has-error' : null }}">
                          {!! Form::label('from', 'From:', ['class'=>'col-sm-2 control-label']) !!}
                          <div class="col-sm-10">
                              {!! Form::input('date', 'from', null, ['class'=>'form-control', 'placeholder'=>'From']) !!}        
                              {!! $errors->first('from', '<span class="text-danger">:message</span>') !!}
                          </div>
                      </div>
                    </div>
                    <!-- /. From -->   
                        
                    <!-- To -->
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('to') ? 'has-error' : null }}">
                            {!! Form::label('to', 'To:', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::input('date', 'to', null, ['class'=>'form-control', 'placeholder'=>'To']) !!}        
                                {!! $errors->first('to', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <!-- /. To -->

                    <!-- Count -->
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('records') ? 'has-error' : null }}">
                            {!! Form::label('records', 'Count:', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::input('number', 'records', null, ['class'=>'form-control', 'placeholder'=>'Count']) !!}        
                                {!! $errors->first('records', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <!-- /. Count -->
                </div>

                <div class="col-sm-12">
                    <!-- Agent Name -->
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : null }}">
                            {!! Form::label('user_id', 'Agent Name:', ['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('user_id', $users, null, ['class'=>'form-control input-sm']) !!}
                                {!! $errors->first('user_id', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <!-- /. Agent Name -->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                     Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            {!! Form::close() !!}

            @if (isset($records) && $records->count() > 0)
                <hr>
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
                                            <td>{{ $record->created_at->format('M-d-Y') }}</td>
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

            @endif
        </div>
    </div>
@stop