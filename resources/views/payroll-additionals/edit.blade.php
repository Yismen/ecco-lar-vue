@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Additionals'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-success">
                        
                    <div class="box-body">       
                       <div class="box-header with-border">
                            <h4>Edit Payroll Additionals <a href="{{ route('admin.payroll-additionals.index') }}" class="pull-right"><i class="fa fa-dashboard"></i> Dashboard</a></h4>
                       </div>
                           
                        {!! Form::model($additional, ['route'=>['admin.payroll-additionals.update', $additional->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}
                           <div class="alert alert-default">
                                <h3>
                                    <strong>Name: </strong> {{ $additional->employee_id }}, {{ $additional->employee->full_name }} <br>
                                    <strong>Date: </strong> {{ $additional->date }}
                                </h3>
                            </div>
                    
                            @include('payroll-additionals._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-warning">UPDATE</button>
                                <button type="reset" class="btn btn-default">CANCEL</button>
                            </div>
                    
                        {!! Form::close() !!}

                        <hr>

                        <div class="col-sm-12">
                            <form action="{{ url('/admin/payroll-additionals', $additional->id) }}" method="POST" class="" style="display: inline-block;">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                            
                                <button type="submit" id="delete-hour" class="btn btn-danger"  name="deleteBtn">
                                    <i class="fa fa-btn fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>  
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop