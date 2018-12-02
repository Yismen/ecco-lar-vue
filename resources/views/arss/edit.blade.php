@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Ars', 'page_description'=>'Create a new ars.'])

@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h4>
                    Edit ARs {{ $ars->name }}
                    <a href="{{ route('admin.arss.index') }}" class="pull-right">
                        <i class="fa fa-home"></i> List
                    </a>
                </h4>
            </div>


            {!! Form::model($ars, ['route'=>['admin.arss.update', $ars->slug], 'method'=>'PATCH', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
                <div class="box-body">

                    @include('arss._form')

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">UPDATE</button>
                    <button type="reset" class="btn btn-default">CANCEL</button>
                </div>
            {!! Form::close() !!}

            <div class="box-footer">
                <form action="{{  route('admin.arss.destroy', $ars->slug) }}" method="POST" class="" style="display: inline-block;">
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}

                    <button type="submit" id="delete-ars" class="btn btn-danger"  name="deleteBtn">
                        <i class="fa fa-btn fa-trash"></i> Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
@stop

@section('scripts')

@stop