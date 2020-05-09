@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'AFP', 'page_description'=>'Create a new afp.'])

@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h4>
                    Edit AFP {{ $afp->name }}
                    <a href="{{ route('admin.afps.index') }}" class="pull-right">
                        <i class="fa fa-home"></i> List
                    </a>
                </h4>
            </div>


            {!! Form::model($afp, ['route'=>['admin.afps.update', $afp->id], 'method'=>'PATCH', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
                <div class="box-body">

                    @include('afps._form')

                </div>

                <div class="box-footer">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-warning">UPDATE</button>
                    </div>
                </div>
            {!! Form::close() !!}

            <div class="box-footer">
                <delete-request-button
                    url="{{ route('admin.afps.destroy', $afp->id) }}"
                    redirect-url="{{ route('admin.afps.index') }}"
                ></delete-request-button>
            </div>

        </div>
    </div>
@stop

@push('scripts')

@endpush
