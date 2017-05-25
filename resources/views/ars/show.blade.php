@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Ars', 'page_description'=>'Details'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    <div class="box-header with-boarder">Details for ARS {{ $ars->name }} </div>
                    <div class="box-body">
                        
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    {{ $ars->name }}
                                    <a href="{{ route('admin.ars.edit', $ars->slug) }}"><i class="fa fa-pencil"></i></a>
                                </span>

                                <strong>ID: </strong> {{ $afp->id }} <br>
                                
                                Employees: <span class="info-box-number">{{ count($ars->employees) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>

                        <a href="{{ route('admin.ars.index') }}"><i class="fa fa-angle-double-left"></i> Back to list</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop