@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Messages'])

@section('content')
    <div class="container-fluid">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-primary">

                <div class="box-body">
                    {!! Form::open(['route'=>['admin.messages.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                       
                        <div class="box-header with-border">
                            <h4>Send Message</h4>
                        </div>
                
                        @include('messages._form')
                
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-mail"></i> SEND MESSAGE
                            </button>
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