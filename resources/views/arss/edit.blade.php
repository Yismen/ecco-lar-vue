@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'ARS', 'page_description'=>'Create a new ars.'])

@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h4>
                    Edit ARS {{ $ars->name }}
                    <a href="{{ route('admin.arss.index') }}" class="pull-right">
                        <i class="fa fa-home"></i> List
                    </a>
                </h4>
            </div>


            {!! Form::model($ars, ['route'=>['admin.arss.update', $ars->id], 'method'=>'PATCH', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
                <div class="box-body">

                    @include('arss._form')

                </div>

                <div class="box-footer">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-warning">UPDATE</button>
                    </div>
                </div>
            {!! Form::close() !!}

            <div class="box-footer">
                <delete-request-button
                    url="{{ route('admin.arss.destroy', $ars->id) }}"
                    redirect-url="{{ route('admin.arss.index') }}"
                ></delete-request-button>
            </div>

        </div>
    </div>
@stop

@section('scripts')

@stop
