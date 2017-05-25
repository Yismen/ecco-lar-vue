@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Payrolls', 'page_description'=>'Import From Excel File'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::open(['url'=>['admin/payrolls/import_from_excel'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}        
                                <legend>Form title</legend>

                                <input type="text" name="name">   

                                <input type="file" name="files">    

                                <button type="submit">Upload</button>                         
                            
                            {!! Form::close() !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop