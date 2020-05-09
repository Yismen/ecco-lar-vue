@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Additional Concepts'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-success">

                    <div class="box-body">
                        {!! Form::open(['route'=>['admin.payroll-additional-concepts.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                           
                            <div class="box-header with-border">
                                <h4>
                                    Create A New Payroll Additional Concept
                                    <a href="{{ route('admin.payroll-additional-concepts.index') }}" class="pull-right"><i class="fa fa-list"></i></a>
                                </h4>
                            </div>
                    
                            @include('payroll-additional-concepts._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">CREATE</button>
                                <button type="reset" class="btn btn-default">RESET</button>
                            </div>
                    
                        {!! Form::close() !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush