@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Additionals'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-success">
                    <div class="box-header with-border">    
                        <h4>
                            Payroll Additionals Management
                            <a href="{{ route('admin.payroll-additionals.create') }}" class="pull-right"><i class="fa fa-plus"></i> Create</a>
                        </h4>
                    </div>

                    <div class="box-body">
                        <div class="col-sm-12">
                            <h4><i class="fa fa-dashboard"></i> Imported Dates</h4>
                            <div class="row">
                                @foreach ($dates as $date)
                                    <div class="col-sm-3">
                                        <div class="alert alert-info">
                                            <a href="{{ route('admin.payroll-additionals.by-date', date("Y-m-d", strtotime($date->date))) }}">
                                                <i class="fa fa-calendar"></i> 
                                                {{ date("M/d/Y", strtotime($date->date)) }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ $dates->render() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop