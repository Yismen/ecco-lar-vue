@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Import Hours'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                        
                    <div class="box-body">
                        {!! Form::open(['route'=>['admin.hours-import.import'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'enctype'=>"multipart/form-data"]) !!}       
                           
                           <div class="box-header with-border"><h4>Import Hours</h4></div>
                    
                            <!-- Select a File -->
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('file_name') ? 'has-error' : null }}">
                                    {!! Form::label('file_name', 'Select a File:', ['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::input('file', 'file_name[]', null, ['class'=>'form-control', 'multiple'=>'multiple']) !!}
                                        {!! $errors->first('file_name', '<span class="text-danger">:message</span>') !!}

                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <span class="text-danger">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /. Select a File -->
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">CANCEL</button>
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </div>
                    
                        {!! Form::close() !!}

                        @include('hours-import._errors')
                    </div>  
                </div>
                @include('hours-import._dashboard')
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop