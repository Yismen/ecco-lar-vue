@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Banks', 'page_description'=>'Edit Banks'])

@section('content')
    <div class="container-fluid">
        <div class="row">       
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    
                    {!! Form::model($bank, ['route'=>['admin.banks.update', $bank->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                       
                       <div class="box-header with-border"><h4>Edit Bank {{ $bank->name }}</h4></div>
                    
                        <div class="box-body">
                            @include('banks._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">CANCEL</button>
                                <button type="submit" class="btn btn-success">UPDATE</button>
                            </div>
                    
                    {!! Form::close() !!}
                </div>  
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop   