@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Create Termination Reasons'])

@section('content')
    <div class="container-fluid">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>    
                        Edit Termination Reason {{ $termination_reason->reason }}
                        <a href="{{ route('admin.termination_reasons.index') }}" title="Return to List" class="pull-right"><i class="fa fa-home"></i></a>
                    </h4>
                </div>

                <div class="box-body">
                    {!! Form::model($termination_reason, ['route'=>['admin.termination_reasons.update', $termination_reason->id], 'method'=>'PUT', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}  
                
                       @include('termination_reasons._form')
                
                        <div class="box-footer">
                            <button type="submit" class="btn btn-warning">SAVE</button>
                            <button type="reset" class="btn btn-default">RESET</button>
                        </div>
                
                    {!! Form::close() !!}
                </div>  

            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop