@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Hours', 'page_description'=>'Add a new Escalations Record!'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                        <h4>
                            Create Hours 
                            <a href="{{ route('admin.escalations_hours.index') }}" class="pull-right" title="Home"><i class="fa fa-list"></i></a>
                        </h4>
                    </div>
                    
                    <div class="box-body">
                        <table class="table table-condensed table-bordered table-striped well">
                            <tbody>
                                <tr>
                                    <th>Records:</th>
                                    <th>Production Hours:</th>
                                    <th>Productivity:</th>
                                </tr>
                                <tr class="text-center">
                                    <td>{{ $record->count }}</td>
                                    <td>0</td>
                                    <td>0.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        {!! Form::open(['route'=>['admin.escalations_hours.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                    
                            <div class="col-sm-12">
                                <!-- User -->
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : null }}">
                                        {!! Form::label('user_id', 'User:', ['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            <label class="form-control bg-gray">{{ $record->user->name }}</label>
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $record->user->id }}">
                                            {!! $errors->first('user_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- /. User -->
                                
                                <!-- Client -->
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('client_id') ? 'has-error' : null }}">
                                        {!! Form::label('client_id', 'Client:', ['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            <label class="form-control bg-gray">{{ $record->escal_client->name }}</label>
                                            <input type="hidden" name="client_id" id="client_id" value="{{ $record->escal_client->id }}">
                                            {!! $errors->first('client_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Client -->
                                
                                <!-- Date -->
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                                        {!! Form::label('date', 'Date:', ['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            <label class="form-control bg-gray">{{ $record->insert_date->format('M/d/Y') }}</label>
                                            <input type="hidden" name="date" id="date" value="{{ $record->insert_date }}">
                                            {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Date -->

                            </div>

                            <div class="col-sm-12">
                                <div class="col-md-4">
                                    <!-- In -->
                                        <div class="form-group {{ $errors->has('entrance') ? 'has-error' : null }}">
                                            {!! Form::label('entrance', 'In:', ['class'=>'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::input('time', 'entrance', null, ['class'=>'form-control', 'placeholder'=>'In']) !!}        
                                                {!! $errors->first('entrance', '<span class="text-danger">:message</span>') !!}
                                            </div>
                                    </div>
                                    <!-- /. In -->
                                </div>

                                <div class="col-md-4">
                                    <!-- Out -->
                                    <div class="form-group {{ $errors->has('out') ? 'has-error' : null }}">
                                        {!! Form::label('out', 'Out:', ['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::input('time', 'out', null, ['class'=>'form-control', 'placeholder'=>'Out']) !!}        
                                            {!! $errors->first('out', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <!-- /. Out -->
                                </div>

                                <div class="col-md-4">
                                    <!-- Break -->
                                    <div class="form-group {{ $errors->has('break') ? 'has-error' : null }}">
                                        {!! Form::label('break', 'Break:', ['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::input('number', 'break', null, ['class'=>'form-control', 'placeholder'=>'Break']) !!}        
                                            {!! $errors->first('break', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <!-- /. Break -->
                                </div>
                            </div>
                    
                            <div class="box-footer with-border">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> CREATE</button>
                                <button type="reset" class="btn btn-default">CANCEL</button>
                            </div>
                    
                        {!! Form::close() !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script src="/js/app.js"></script> --}}
@endpush