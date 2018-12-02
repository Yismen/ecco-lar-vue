
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Cards', 'page_description'=>'Create a new card.'])

@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h4>
                    Add AFP
                    <a href="{{ route('admin.afps.index') }}" class="pull-right">
                        <i class="fa fa-home"></i> List
                    </a>
                </h4>
            </div>

            {!! Form::open(['route'=>['admin.afps.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
                <div class="box-body">

                    @include('afps._form')

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                    <button type="reset" class="btn btn-default">CANCEL</button>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@stop

@section('scripts')

@stop
