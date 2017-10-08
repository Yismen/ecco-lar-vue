@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Edit Hours'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                        
                    <div class="box-body">
                            
                        {!! Form::model($hour, ['route'=>['admin.hours.update', $hour->id], 'method'=>'PUT', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                           <div class="box-header with-border">
                                <h4>Edit Hours <a href="{{ route('admin.hours.index') }}" class="pull-right"><i class="fa fa-dashboard"></i> Dashboard</a></h4>
                           </div>
                           <div class="alert alert-default">
                                <h3>
                                    <strong>Name: </strong> {{ $hour->employee_id }}, {{ $hour->employee->full_name }} <br>
                                    <strong>Date: </strong> {{ $hour->date }}
                                </h3>
                            </div>
                    
                            @include('hours._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-warning">UPDATE</button>
                                <button type="reset" class="btn btn-default">CANCEL</button>
                            </div>
                    
                        {!! Form::close() !!}

                        <hr>

                        <div class="col-sm-12">
                            <form action="{{ url('/admin/hours', $hour->id) }}" method="POST" class="" style="display: inline-block;">
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