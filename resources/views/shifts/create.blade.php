@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Menus', 'page_description'=>'List of Menu Items'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    {!! Form::open(['route'=>['admin.shifts.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'novalidate' => true]) !!}

                        <div class="box-header with-border">
                            <h4>
                                New Menu Shift
                                <a href="{{ route('admin.shifts.index') }}" class="pull-right">
                                    <i class="fa fa-home"></i>
                                        Return to List
                                </a>
                            </h4>
                        </div>

                        <div class="box-body">
                            @include('shifts._form')
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
        </div>
    </div>
@endsection
@push('scripts')

@endpush
