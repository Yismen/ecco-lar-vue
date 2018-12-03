@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Create a new Nationality.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">


                    {!! Form::open(['route'=>['admin.nationalities.store'], 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}
                        <div class="box-header with-border">
                            <h4>
                                Add a New Nationality
                                <a href="{{ route('admin.nationalities.index') }}" class="pull-right" title="Back to Main Page"><i class="fa fa-list"></i></a>
                            </h4>
                        </div>
                        {{-- /. .box-header --}}
                        <div class="box-body">
                            @include('nationalities._form')
                        </div>
                        {{-- /. .box-body --}}
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                            <button type="reset" class="btn btn-default">CANCEL</button>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop