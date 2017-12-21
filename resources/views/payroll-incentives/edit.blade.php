@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Incentives'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-success">
                        
                    <div class="box-body">       
                       <div class="box-header with-border">
                            <h4>
                                Edit Payroll Incentives 
                                <a href="{{ route('admin.payroll-incentives.details',  [$incentive->date, $incentive->employee_id]) }}" class="pull-right">
                                    <i class="fa fa-angle-double-left"></i> Back</a>
                            </h4>
                       </div>
                           
                        {!! Form::model($incentive, ['route'=>['admin.payroll-incentives.update', $incentive->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}
                           <div class="alert alert-default">
                                <h3>
                                    <strong>Name: </strong> {{ $incentive->employee_id }}, {{ $incentive->employee->full_name }} <br>
                                    <strong>Date: </strong> {{ $incentive->date }}
                                </h3>
                            </div>
                    
                            @include('payroll-incentives._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-warning">UPDATE</button>
                                <button type="reset" class="btn btn-default">CANCEL</button>
                            </div>
                    
                        {!! Form::close() !!}

                        <hr>

                        <div class="col-sm-12">
                            <form action="{{ url('/admin/payroll-incentives', $incentive->id) }}" method="POST" class="" style="display: inline-block;">
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