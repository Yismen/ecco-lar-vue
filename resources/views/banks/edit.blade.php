@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Banks', 'page_description'=>'Edit Banks'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    {!! Form::model($bank, ['route'=>['admin.banks.update', $bank->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}

                       <div class="box-header with-border">
                            <h4>
                                Edit Bank {{ $bank->name }}
                                <a href="{{ route('admin.banks.index') }}" class="pull-right">
                                    <i class="fa fa-home"></i>
                                    List
                                </a>
                            </h4>
                       </div>

                        <div class="box-body">
                            @include('banks._form')

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">UPDATE</button>
                                <button type="reset" class="btn btn-default">CANCEL</button>
                            </div>

                    {!! Form::close() !!}

                    <div class="box-footer">
                        <delete-request-button
                            url="{{ route('admin.banks.destroy', $bank->id) }}"
                            redirect-url="{{ route('admin.banks.index') }}"
                        ></delete-request-button>
                    </div>
                    {{-- ./ Delete form --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop