@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Create Termination Types'])

@section('content')
    <div class="container-fluid">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>
                        Create New Termination Type
                        <a href="{{ route('admin.termination_types.index') }}" title="Return to List" class="pull-right"><i class="fa fa-home"></i></a>
                    </h4>
                </div>

                <form action="{{ route('admin.termination_types.store') }}" method="POST">
                    <div class="box-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                       @include('termination_types._form')
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">CREATE</button>
                        <button type="reset" class="btn btn-default">RESET</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
