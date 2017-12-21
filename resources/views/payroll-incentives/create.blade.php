@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Incentives'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-success">
                        
                    <div class="box-body">
                        {!! Form::open(['route'=>['admin.payroll-incentives.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                           
                           <div class="box-header">
                                <h4>
                                    Create New Incentive 
                                    <a href="{{ route('admin.payroll-incentives.index') }}" class="pull-right"><i class="fa fa-list"></i></a>
                                </h4>
                           </div>
                    
                            @include('payroll-incentives._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
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