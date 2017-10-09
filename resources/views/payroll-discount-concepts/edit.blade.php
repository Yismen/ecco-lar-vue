@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Discount Concepts'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                
                    <div class="box-body">
                        {!! Form::model($concept, ['route'=>['admin.payroll-discount-concepts.update', $concept->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                           
                           <div class="box-header with-border">
                                <h4>
                                    Edit Concept {{ $concept->name }} 
                                    <a href="{{ route('admin.payroll-discount-concepts.index') }}" class="pull-right"><i class="fa fa-list"></i></a>
                                </h4>
                           </div>
                    
                            @include('payroll-discount-concepts._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                                <button type="reset" class="btn btn-default">CANCEL</button>
                            </div>
                    
                        {!! Form::close() !!}
                    </div>  
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop