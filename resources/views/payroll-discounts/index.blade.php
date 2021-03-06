@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Discounts'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-warning">
                    <div class="box-header with-border">    
                        <h4>
                            <div class="col-sm-8">
                                Payroll Discounts Management
                            </div>
                            <div class="col-sm-2 pull-right">
                                <a href="{{ route('admin.payroll-discounts.create') }}" class="pull-right"><i class="fa fa-plus"></i> Create</a>
                            </div>
                            <div class="col-sm-2 pull-right">
                                <a href="{{ route('admin.payroll-discounts.import') }}" class="pull-right"><i class="fa fa-upload"></i> Import</a>                            
                            </div>
                        </h4>
                        </h4>
                    </div>

                    <div class="box-body">
                        <div class="col-sm-12">
                            <h4><i class="fa fa-dashboard"></i> Imported Dates</h4>
                            <div class="row">
                                @foreach ($dates as $date)
                                    <div class="col-sm-3">
                                        <div class="alert alert-warning">
                                            <a href="{{ route('admin.payroll-discounts.by-date', date("Y-m-d", strtotime($date->date))) }}">
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
@push('scripts')

@endpush