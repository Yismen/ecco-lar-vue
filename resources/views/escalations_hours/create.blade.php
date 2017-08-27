@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Hours', 'page_description'=>'Add a new Escalations Record!'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    <div class="box-body">
                        {!! Form::open(['route'=>['admin.escalations_hours.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                           
                           <div class="box-header with-border"><h4>Create Hours</h4></div>
                    
                            @include('escalations_hours._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">CANCEL</button>
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </div>
                    
                        {!! Form::close() !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script src="/js/app.js"></script> --}}
@stop