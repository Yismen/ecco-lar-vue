@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Import Employees Data', 'page_description'=>'description'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    <div class="box-body">
                        {!! Form::open(['route'=>['admin.imports.employees'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}

                           <div class="box-header with-border"><h4>Import Employees Data</h4></div>

                            @include('imports._form')

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                                <button type="submit" class="btn btn-default">CANCEL</button>
                            </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
