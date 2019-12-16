@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Create Supervisor Users', 'page_description'=>'List of Menu Items'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>
                            Relate Users to Supervisors
                            <a href="{{ route('admin.supervisor_users.index') }}" class="pull-right">
                                <i class="fa fa-home"></i>
                                    Return to List
                            </a>
                        </h4>
                    </div>
                    
                    {!! Form::open(['route'=>['admin.supervisor_users.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'novalidate' => true]) !!}

                        <div class="box-body">
                            @include('supervisor_users._form')
                        </div>

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
                {{-- .box --}}
            </div>
            {{-- .col/form--}}

            <div class="col-xs-12">
                @include('supervisor_users._assigned')
            </div>
            
        </div>
        {{-- .row --}}
    </div>
@endsection
@section('scripts')

@stop
