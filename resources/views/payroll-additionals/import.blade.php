@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Additionals'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    

                    <div class="box-body">
                        {!! Form::open(['route'=>['admin.payroll-additionals.import'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                           
                            <div class="box-header with-border">
                                <h4>
                                    Import Additional Incomes From Excel File 
                                    <a href="{{ route('admin.payroll-additionals.index') }}" class="pull-right"><i class="fa fa-list"></i></a>
                                </h4>
                            </div>
                    
                            <!-- Select Files -->
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('additionals-file') ? 'has-error' : null }}">
                                    {!! Form::label('additionals-file', 'Select Files:', ['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::input('file', 'additionals-file[]', null, ['class'=>'form-control', 'placeholder'=>'Select Files', 'multiple']) !!}        
                                        {!! $errors->first('additionals-file', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /. Select Files -->
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> UPLOAD</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> RESET</button>
                            </div>
                    
                        {!! Form::close() !!}
                    </div>  
                    
                    @include('layouts.partials.file-import-errors')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop