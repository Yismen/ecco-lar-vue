@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Incentive Concepts'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-success">

                    <div class="box-body">
                        {!! Form::open(['route'=>['admin.payroll-incentive-concepts.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                           
                            <div class="box-header with-border">
                                <h4>
                                    Create A New Payroll Incentive Concept
                                    <a href="{{ route('admin.payroll-incentive-concepts.index') }}" class="pull-right"><i class="fa fa-list"></i></a>
                                </h4>
                            </div>
                    
                            @include('payroll-incentive-concepts._form')
                    
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
@section('scripts')

@stop